<?php
require "dbconnect.php";

if(strlen($_GET['name']) >= 3)
{
    try{
        $sql = 'INSERT INTO product(name, short_description, long_description, rental_price, is_in_stock, quantity, min_rental_time, image, category_id) VALUES(:name, :short_description, :long_description, :rental_price,:is_in_stock,:quantity,:min_rental_time,:image,:category_id)';
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':name', $_GET['name']);
        $stmt->bindValue(':short_description', $_GET['short_description']);
        $stmt->bindValue(':long_description', $_GET['description']);
        $stmt->bindValue(':rental_price', $_GET['rental_price']);
        $stmt->bindValue(':is_in_stock', $_GET['is_in_stock']);
        $stmt->bindValue(':quantity', 10);
        $stmt->bindValue(':min_rental_time', $_GET['min_rental_time']);
        $stmt->bindValue(':image', $_GET['image']);
        $stmt->bindValue(':category_id', $_GET['category_id']);
        $stmt->execute();

        $_SESSION['msg'] = "Товар добавлен.";

    }catch (PDOException $error) {
        $_SESSION['msg'] = "Ошибка: " . $error->getMessage();
    }
}
else
{
    $_SESSION['msg'] = "Ошибка: Название товара должно содержать не менее 3х символов.";
}

header('Location:http://toolrental/index.php?page=prod');
exit();
