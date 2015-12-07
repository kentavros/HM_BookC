<?php
require_once'../inc/functions.php';
require_once'../inc/admin_config.php'
?>
<?php
//Начало страницы
$title = 'Adminzone';
require_once'../inc/head.php';
?>
<?php
//Админ - Формы
require_once'../inc/admin_forms.php';
?>
<?php
//Список книг
echo '<table cellpadding="4">
        <tr><td></td><td><b>Название книги</b></td><td style="text-align: center"><b>Жанр</b></td>
        <td style="text-align: center"><b>Автор</b></td>
        <td><b>Цена, грн.</b></td><td><b>Краткое описание</b></td></tr>';
$i=1;
if(is_array(Book::get_books())) {
    foreach (Book::get_books() as $array_book) {
        echo '<tr><td>' . $i . '.</td><td>' . $array_book['title'] . '</td>
        <td>' . wordwrap(implode(', ', Genre::get_genres_by_id_book($array_book['id'])), 25, "<br />") . '</td>
        <td>' . wordwrap(implode(', ', Author::get_authors_by_id_book($array_book['id'])), 25, "<br />") . '</td>
        <td>' . $array_book['price'] . '</td>
        <td>' . trim(mb_substr($array_book['description'], 0, 30, 'UTF-8')) .
            ' <a href="index.php?id=' . $array_book['id'] . '&edit=1">Изменить
        </a>/<a href="index.php?id=' . $array_book['id'] . '&edit=2">Удалить</a></td></tr>';
        $i++;
    }
}
echo '</table>';
?>

<?php
require_once'../inc/bottom.php';
?>