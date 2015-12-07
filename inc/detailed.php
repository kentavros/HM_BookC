<?php
require_once 'functions.php';
?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['address']) && !empty($_POST['customer']) && !empty($_POST['copies'])) {
        $book = Book::get_book($_POST['id']);
        $copies = (int)$_POST['copies'];
        $price = $book->get_price() * $copies;
        echo '<h4>Ваш заказ принят!</h4>';
        echo 'Вы заказали: ' . $book->get_title() . ', на сумму ' . $price . ' грн.<hr />';
        //Подготовка и Отправка письма админу с заказом
        $to = 'admin@example.com';
        $subject = 'Заказ книг';
        $message = "1. Клиент: {$_POST['customer']} \r\n2. Адрес клиента: {$_POST['address']}\r\n";
        $message .= "3. Книга: {$book->get_title()}\r\n";
        $message .= "4. Число копий: {$copies} \r\n5. Сумма к оплате: {$price}. грн.";
        $message = wordwrap($message, 70, "\r\n");
        $headers = 'From: order_book@example.com'."\r\n";
        if(mail($to,$subject,$message,$headers)){
            echo 'Письмо отправлено!';
        } else {
            echo 'Что-то пошло не так, письмо не отправлено!';
        }
    } else {
        $book = Book::get_book($_POST['id']);
        $_SESSION['msg'] = 'Заполните все поля!';
        header('Location: detailed.php?id='.$book->get_id().'&form=1');
        exit;
    }
} else {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Каталог книг <?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
    <?php
    echo $_SESSION['msg'];
    if (is_object($book) || isset($_GET['id'])) {
        $book = Book::get_book($_GET['id']);
        echo '<h3>' . $book->get_title() . '</h3>';
        echo '<h4>Относится к жанру:</h4>' . implode(', ', Genre::get_genres_by_id_book($book->get_id()));
        echo '<h4>Автор:</h4>' . implode(', ', Author::get_authors_by_id_book($book->get_id()));
        echo '<h4>Цена:</h4>' . $book->get_price() . ' грн.<hr />';
        echo 'Описание: <br />';
        echo wordwrap($book->get_description(), 150, '<br />');
        echo '<hr />';
        echo '<a href="detailed.php?id=' . $book->get_id() . '&form=1">Закакзать эту книгу&crarr;</a>';

    }
//Начало формы заказа
    if (isset($_GET['form']) && !empty($_GET['form'])) {
        ?>
        <form action="" method="post">
            <fieldset style="width: 20%">
                <legend style="font-weight: bold">Заказать книгу: <?php echo $book->get_title(); ?> </legend>
                <table>
                    <tr>
                        <td><label for="address">Адрес:</label></td>
                        <td><input type="text" id="address" name="address"/></td>
                    </tr>
                    <tr>
                        <td><label for="customer">ФИО:</label></td>
                        <td><input type="text" id="customer" name="customer"/></td>
                    </tr>
                    <tr>
                        <td><label for="copies">Экземпляров:</label></td>
                        <td><input type="text" id="copies" name="copies"/></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="id" value="<?php echo $book->get_id(); ?>"/></td>
                        <td><input type="submit" name="submit" value="Заказать"/></td>
                    </tr>
                </table>
            </fieldset>

        </form>
<?php
//Конец формы заказа
    }
}
?>
<br /><a href="../index.php">&lArr;Назад</a>
<?php
require_once'bottom.php';
?>