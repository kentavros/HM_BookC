<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Добавление нового жанра
    if(isset($_POST['add_genre'])) {
        Genre::add_genre($_POST['add_genre']);
    }
    //Добавление нового автора
    elseif(isset($_POST['add_author'])){
        Author::add_author($_POST['add_author']);
    }
    //Добавление книги
    if(!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['genre'])
        && !empty($_POST['price']) && !empty($_POST['description'])){
        if(!empty($_POST['id'])){
            //Редактирование существующей книги
            Book::edit_book();
        } else {
            //Добавление новой книги
            Book::add_book();
        }

    } else{
        echo 'Заполните все поля формы "Добавить книгу"!';
    }
}
//Удаление книги
if(isset($_GET['edit']) && $_GET['edit'] == 2){
    Book::delete_book($_GET['id']);
}
//Вывод сообщения по act.
switch($_GET['act']){
    case 1:
        echo 'Книга добавлена!';
        break;
    case 2:
        echo 'Такая книга уже есть!';
        break;
    case 3:
        echo 'Жанр добавлен!';
        break;
    case 4:
        echo 'Такой жанр уже есть!';
        break;
    case 5:
        echo 'Заполните поле жанра!';
        break;
    case 6:
        echo 'Автор добавлен!';
        break;
    case 7:
        echo 'Такой автор уже есть!';
        break;
    case 8:
        echo 'Заполните поле Автор';
        break;
    case 9:
        echo 'Книга успешно отредактирована!';
        break;
    case 10;
        echo 'Книга удалена!';
        break;
}
?>