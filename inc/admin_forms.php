<?php
if(isset($_GET['edit']) && $_GET['edit'] == 1){
    $book = Book::get_book($_GET['id']);
}
?>
<!--Форма для добавления / редактирования книг-->
<form method="post" action="index.php">
    <fieldset style="width: 30%">
        <legend style="font-weight: bold">Добавить книгу:</legend>
        <table>
            <tr><td><label for="title">Название</label></td>
                <td><input type="text" id="title" name="title" value="<?php if(is_object($book)){echo $book->get_title();} ?>" /></td></tr>
            <tr><td>Автор</td>
                <td>
                    <?php

                    foreach(Author::get_authors() as $id => $name){
                        echo '<input type="checkbox" name="author[]" value="'.$id.'" ';
                        if(is_object($book)){
                            if(in_array($name, Author::get_authors_by_id_book($book->get_id()))){
                                echo 'checked';
                            }
                        }
                        echo ' />'.$name;
                    }
                    ?>
                </td></tr>
            <tr><td>Жанр</td>
                <td>
                    <?php
                    foreach(Genre::get_genres() as $id => $name){
                        echo '<input type="checkbox" name="genre[]" value="'.$id.'" ';
                        if(is_object($book)){
                            if(in_array($name, Genre::get_genres_by_id_book($book->get_id()))){
                                echo 'checked';
                            }
                        }
                        echo ' />'.$name;
                    }
                    ?>
                </td></tr>
            <tr><td><label for="price">Стоимость</label></td>
                <td><input type="text" id="price" name="price" value="<?php if(is_object($book)){echo $book->get_price();} ?>" /></td></tr>
            <tr><td>Описание</td>
                <td><textarea name="description" rows="8" cols="30"><?php if(is_object($book)){echo $book->get_description();} ?></textarea></td></tr>
            <tr><td><input type="hidden" name="id" value="<?php if(is_object($book)){echo $book->get_id();} ?>" /></td>
                <td><input type="submit" name="submit" value="<?php if(is_object($book)){ echo 'Изменить';} else { echo 'Добавить'; }?>" /></td></tr>
        </table>
    </fieldset>
</form>
<!--Форма для добавления жанра-->
<form method="post" action="index.php">
    <fieldset style="width: 17%">
        <legend style="font-weight: bold">Добавить жанр:</legend>
        <table>
            <tr><td><label for="genre">Жанр</label></td>
                <td><input type="text" id="genre" name="add_genre" /></td></tr>
            <tr><td></td>
                <td><input type="submit" name="submit" value="Добавить" /></td></tr>
        </table>
    </fieldset>
</form>
<!--Форма для добавления автора-->
<form method="post" action="index.php">
    <fieldset style="width: 17%">
        <legend style="font-weight: bold">Добавить автора:</legend>
        <table>
            <tr><td><label for="author">Автор</label></td>
                <td><input type="text" id="author" name="add_author" /></td></tr>
            <tr><td></td>
                <td><input type="submit" name="submit" value="Добавить" /></td></tr>
        </table>
    </fieldset>
</form>