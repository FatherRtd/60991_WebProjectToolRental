<?php
require "dbconnect.php";

try{
    $sql = 'INSERT INTO rental_order(user_id, product_id, order_date,  is_done) VALUES(:user_id, :product_id, :order_date, :is_done)';
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':user_id', $_SESSION['user_id']);
    $stmt->bindValue('product_id',$_POST['product_id']);
    $stmt->bindValue(':order_date', date('Y-m-d H:i:s'));
    $stmt->bindValue(':is_done', 0);
    $stmt->execute();

    $sql = 'UPDATE product SET is_in_stock = 0 where id=:id';
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':id', $_POST['product_id']);
    $stmt->execute();

    $_SESSION['msg'] = "Товар арендован.";
}catch (PDOException $error) {
    $_SESSION['msg'] = "Ошибка: " . $error->getMessage();
}

header('Location:index.php');
exit();