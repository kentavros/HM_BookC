<?php
require_once 'inc/functions.php';
?>
<?php
//Начало страницы
$title = '';
require_once 'inc/head.php';
?>
<h4>Выберите жанр:</h4>
<form action="index.php" method="post">
    <?php
    foreach (Genre::get_genres() as $id => $value) {
        echo '<button name="genre" value="' . $id . '">' . $value . '</button>';
    }
    ?>
</form>
<h4>Выберите автора:</h4>
<form action="index.php" method="post">
    <?php
    foreach (Author::get_authors() as $id => $value) {
        echo '<button name="author" value="' . $id . '">' . $value . '</button>';
    }
    ?>
</form>
<h4>Список книг</h4>
<?php
require_once 'inc/list.php'
?>
<?php
//конец страницы
require_once 'inc/bottom.php';
?>