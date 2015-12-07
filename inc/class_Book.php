<?php
class Book{
    private $id;
    Private $title;
    private $price;
    private $description;


    public function __construct($id, $title, $price, $description){
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->description =$description;
    }

    public function get_id(){
        return $this->id;
    }

    public function get_title(){
        return $this->title;
    }

    public function get_price(){
        return $this->price;
    }

    public function get_description(){
        return $this->description;
    }

    /**
     * Получение объекта - книга
     * @param $id
     * @return object
     */
    static public function get_book($id){
        global $mysqli;
        $sql="SELECT * FROM books WHERE id = '".$id."'";
        $result = $mysqli->query($sql);
        $row=$result->fetch_assoc();
        return new Book($row['id'],$row['title'],$row['price'],$row['description']);
    }

    /**
     * получение массива книг
     * @return $books array
     */
    static public function get_books(){
        global $mysqli;
        $sql="SELECT * FROM books";
        $result = $mysqli->query($sql);
        $books = array();
        while ($row=$result->fetch_assoc()){
            $books[]=array('id'=>$row['id'],
                            'title'=>$row['title'],
                            'price'=>$row['price'],
                            'description'=>$row['description']);
        }
        return $books;
    }

    /**
     * Получение массива книг из массива id книг
     * @param $array_id
     * @return array
     */
    static public function get_books_by_id($array_id){
        global $mysqli;
        $sql = "SELECT * FROM books WHERE id IN (".implode(",",$array_id).")";
        $result = $mysqli->query($sql);
        $books = array();
        while($row = $result->fetch_assoc()){
            $books[]=array('id'=>$row['id'],
                'title'=>$row['title'],
                'price'=>$row['price'],
                'description'=>$row['description']);
        }
        return $books;
    }

    /**
     * получаем массив книг по id жанра
     * @param $id_genre
     * @return array
     */
    static public function get_books_by_id_genre($id_genre){
        global $mysqli;
        $sql = "SELECT * FROM sum_genre WHERE id_genre = '".$id_genre."'";
        $result = $mysqli->query($sql);
        $id_books = array();
        while($row = $result->fetch_assoc()){
            $id_books[]=$row['id_book'];
        }
        return self::get_books_by_id($id_books);
    }

    /**
     * получаем массив книг по id автора
     * @param $id_author
     * @return array
     */
    static public function get_books_by_id_author($id_author){
        global $mysqli;
        $sql = "SELECT * FROM sum_author WHERE id_author = '".$id_author."'";
        $result = $mysqli->query($sql);
        $id_books = array();
        while($row = $result->fetch_assoc()){
            $id_books[]=$row['id_book'];
        }
        return self::get_books_by_id($id_books);
    }

    /**
     * Удаление книги по $id
     */
    static public function delete_book($id){
        global $mysqli;
        $sql = "DELETE FROM books WHERE id='".$id."'";
        $mysqli->query($sql);
        $sql = "DELETE FROM sum_genre WHERE id_book = '".$id."'";
        $mysqli->query($sql);
        $sql = "DELETE FROM sum_author WHERE id_book = '".$id."'";
        $mysqli->query($sql);
        header('Location: index.php?act=10');
    }

    /**Проверка, существует ли книга
     * @param $title
     * @param $price
     * @param $description
     * @return bool
     */
    static private function exists_book($title, $price, $description){
        global $mysqli;
        $sql = "SELECT * FROM books WHERE title = '".$title."' AND price='".$price."' AND description = '".$description."'";
        $result = $mysqli->query($sql);
        if($result->num_rows == 0){
            //Такой книги нет - return false
            return false;
        } else {
            //Такая книга есть - return true
            return true;
        }
    }

    /**
     * Добавить книгу.
     */
    static public function add_book(){
        global $mysqli;
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        if(!self::exists_book($title, $price, $description)) {
            //такой книги нет
            $sql = "INSERT INTO books (title, price, description) VALUES ";
            $sql .="('".$title."', '".$price."', '".$description."')";
            $mysqli->query($sql);
            //id добавленной книги
            //Добавляем id жанра и книги в таблицу sum_genre
            $id_book  = $mysqli->insert_id;
            $array_genre = $_POST['genre'];
            $count_genre = count($array_genre);
            for($i=0; $i<$count_genre; $i++){
                $sql = "INSERT INTO sum_genre (id_genre, id_book) VALUES ";
                $sql .="('".$array_genre[$i]."', '".$id_book."')";
                $mysqli->query($sql);
            }
            //Добавляем Авторов
            $array_author = $_POST['author'];
            $count_author = count($array_author);
            for($i=0; $i<$count_author; $i++){
                $sql = "INSERT INTO sum_author (id_author, id_book) VALUES ";
                $sql .= "('".$array_author[$i]."', '".$id_book."')";
                $mysqli->query($sql);
            }
            //Книга добавлена
            header('Location: index.php?act=1');
        } else {
           //Такая книга есть
            header('Location: index.php?act=2');
        }
    }

    /**
     * Редактирование книги
     */
    static public function edit_book(){
        global $mysqli;
        $sql = "UPDATE books SET title = '".$_POST['title']."', price = '".$_POST['price']."', ";
        $sql .="description = '".$_POST['description']."' WHERE id = '".$_POST['id']."'";
        $mysqli->query($sql);
        //делаем изменения в сводных таблицах (Авторов Жанров)
        $id_book  = $_POST['id'];
        $array_genre = $_POST['genre'];
        $count_genre = count($array_genre);
        $sql = "DELETE FROM sum_genre WHERE id_book = '".$id_book."'";
        $mysqli->query($sql);
        for($i=0; $i<$count_genre; $i++){
            $sql = "INSERT INTO sum_genre (id_genre, id_book) VALUES ";
            $sql .="('".$array_genre[$i]."', '".$id_book."')";
            $mysqli->query($sql);
        }
        //Добавляем Авторов
        $array_author = $_POST['author'];
        $count_author = count($array_author);
        $sql = "DELETE FROM sum_author WHERE id_book = '".$id_book."'";
        $mysqli->query($sql);
        for($i=0; $i<$count_author; $i++){
            $sql = "INSERT INTO sum_author (id_author, id_book) VALUES ";
            $sql .= "('".$array_author[$i]."', '".$id_book."')";
            $mysqli->query($sql);
        }
        header('Location: index.php?act=9');
    }
}
?>