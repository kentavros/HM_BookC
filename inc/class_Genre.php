<?php

class Genre{

    /**
     * Возвращает массив жанров из БД
     * @return $genres - array
     */
    static public function get_genres(){
        global $mysqli;
        $sql = "SELECT * FROM genres";
        $result = $mysqli->query($sql);
        $genres = array();
        while($row = $result->fetch_assoc()){
            $genres[$row['id']]= $row['name'];
        }
        return $genres;
    }

    /**
     * Получаем массив Жанров из массива id
     * @param $array_id
     * @return array
     */
    static public function get_genres_by_id($array_id){
        global $mysqli;
        $sql = "SELECT * FROM genres WHERE id IN (".implode(",",$array_id).")";
        $result = $mysqli->query($sql);
        $genres = array();
        while($row = $result->fetch_assoc()){
            $genres[]=$row['name'];
        }
        return $genres;
    }

    /**
     *
     * @param $id_book
     * @return array - жанры
     *
     */
    static public function get_genres_by_id_book($id_book){
        global $mysqli;
        $sql = "SELECT * FROM sum_genre WHERE id_book='".$id_book."'";
        $result = $mysqli->query($sql);
        $genres_id = array();
        while($row = $result->fetch_assoc()){
            $genres_id[]=$row['id_genre'];
        }
        return self::get_genres_by_id($genres_id);
        }


    /** проверка на существование */
    static private function exists_genre($name){
        global $mysqli;

            $sql = "SELECT * FROM genres WHERE name = '" . $name . "'";
            $result = $mysqli->query($sql);
            if ($result->num_rows == 0) {
                //Такого жанра нет
                return false;
            } else {
                //Такой жанр есть
                return true;
            }
    }

    /**Добавляет Жанр в БД
     * @param $name
     * @return bool
     */
    static public function add_genre($name){
        global $mysqli;
        if(!empty($name)) {
            if (!self::exists_genre($name)) {
                $sql = "INSERT INTO genres (name) VALUES ('" . $name . "')";
                if ($mysqli->query($sql)) {
                    //Жанр добавлен
                    header('Location: index.php?act=3');
                } else {
                    return false;
                }
            } else {
                //Такой жанр есть
                header('Location: index.php?act=4');
            }
        } else {
                //пустое поле
                header('Location: index.php?act=5');
        }
    }

}













?>