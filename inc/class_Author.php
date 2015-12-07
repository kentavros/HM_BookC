<?php

class Author {

    /**
     * Возвращает массив авторов из БД
     * @return $authors - array
     */
    static public function get_authors(){
        global $mysqli;
        $sql = "SELECT * FROM authors";
        $result = $mysqli->query($sql);
        $authors = array();
        while ($row = $result->fetch_assoc()){
            $authors[$row['id']]=$row['name'];
        }
        return $authors;
    }

    /**
     * Получаем массив имен Авторов из массива id
     * @param $array_id
     * @return array
     */
    static public function get_authors_by_id($array_id){
        global $mysqli;
        $sql = "SELECT * FROM authors WHERE id IN (".implode(",",$array_id).")";
        $result = $mysqli->query($sql);
        $authors = array();
        while($row = $result->fetch_assoc()){
            $authors[]=$row['name'];
        }
        return $authors;
    }

    /**
     * Получаем  массив с авторами
     * @param $id_book
     * return $authors array
     */
    static public function get_authors_by_id_book($id_book){
        global $mysqli;
        $sql = "SELECT * FROM sum_author WHERE id_book = '".$id_book."'";
        $result = $mysqli->query($sql);
        $authors_id = array();
        while($row = $result->fetch_assoc()){
            $authors_id[] = $row['id_author'];
        }
        return self::get_authors_by_id($authors_id);
    }



    /** проверка на существование */
    static private function exists_author($name){
        global $mysqli;

        $sql = "SELECT * FROM authors WHERE name = '" . $name . "'";
        $result = $mysqli->query($sql);
        if ($result->num_rows == 0) {
            //Такого автора нет
            return false;
        } else {
            //Такой автор есть
            return true;
        }
    }

    /**Добавляет Автора в БД
     * @param $name
     * @return bool
     */
    static public function add_author($name){
        global $mysqli;
        if(!empty($name)) {
            if (!self::exists_author($name)) {
                $sql = "INSERT INTO authors (name) VALUES ('" . $name . "')";
                if ($mysqli->query($sql)) {
                    //Автор добавлен
                    header('Location: index.php?act=6');
                } else {
                    return false;
                }
            } else {
                //Такой Автор есть
                header('Location: index.php?act=7');
            }
        } else {
            //пустое поле
            header('Location: index.php?act=8');
        }
    }
}
?>