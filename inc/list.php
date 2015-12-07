<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['genre'])){
        echo '<table cellpadding="4">
        <tr><td></td><td><b>Название книги</b></td><td style="text-align: center"><b>Жанр</b></td>
        <td style="text-align: center"><b>Автор</b></td>
        <td><b>Цена, грн.</b></td><td><b>Краткое описание</b></td></tr>';
        $i=1;
        if(is_array(Book::get_books_by_id_genre($_POST['genre']))) {
            foreach (Book::get_books_by_id_genre($_POST['genre']) as $array_book) {
                echo '<tr><td>' . $i . '.</td><td>' . $array_book['title'] . '</td>
        <td>' . implode(', ', Genre::get_genres_by_id_book($array_book['id'])) . '</td>
        <td>' . implode(', ', Author::get_authors_by_id_book($array_book['id'])) . '</td>
        <td>' . $array_book['price'] . '</td>
        <td>' . trim(mb_substr($array_book['description'], 0, 30, 'UTF-8')) .
                    '<a href="inc/detailed.php?id=' . $array_book['id'] . '"> >>Подробнее</a></td></tr>';
                $i++;
            }
        }
        echo '</table>';
    }elseif(isset($_POST['author'])){
        echo '<table cellpadding="4">
        <tr><td></td><td><b>Название книги</b></td><td style="text-align: center"><b>Жанр</b></td>
        <td style="text-align: center"><b>Автор</b></td>
        <td><b>Цена, грн.</b></td><td><b>Краткое описание</b></td></tr>';
        $i=1;
        if(is_array(Book::get_books_by_id_author($_POST['author']))) {
            foreach (Book::get_books_by_id_author($_POST['author']) as $array_book) {
                echo '<tr><td>' . $i . '.</td><td>' . $array_book['title'] . '</td>
        <td>' . implode(', ', Genre::get_genres_by_id_book($array_book['id'])) . '</td>
        <td>' . implode(', ', Author::get_authors_by_id_book($array_book['id'])) . '</td>
        <td>' . $array_book['price'] . '</td>
        <td>' . trim(mb_substr($array_book['description'], 0, 30, 'UTF-8')) .
                    '<a href="inc/detailed.php?id=' . $array_book['id'] . '"> >>Подробнее</a></td></tr>';
                $i++;
            }
        }
        echo '</table>';
    }
} else {
    echo '<table cellpadding="4">
        <tr><td></td><td><b>Название книги</b></td><td style="text-align: center"><b>Жанр</b></td>
        <td style="text-align: center"><b>Автор</b></td>
        <td><b>Цена, грн.</b></td><td><b>Краткое описание</b></td></tr>';
    $i=1;
    if(is_array(Book::get_books())) {
        foreach (Book::get_books() as $array_book) {
            echo '<tr><td>' . $i . '.</td><td>' . $array_book['title'] . '</td>
        <td>' . implode(', ', Genre::get_genres_by_id_book($array_book['id'])) . '</td>
        <td>' . implode(', ', Author::get_authors_by_id_book($array_book['id'])) . '</td>
        <td>' . $array_book['price'] . '</td>
        <td>' . trim(mb_substr($array_book['description'], 0, 30, 'UTF-8')) .
                '<a href="inc/detailed.php?id=' . $array_book['id'] . '"> >>Подробнее</a></td></tr>';
            $i++;
        }
    }
    echo '</table>';
}

?>