<?php
require "dbconnect.php";
$enddate = date('Y-m-d H:i:s', strtotime($_POST['end_date']));
$days = ceil((strtotime($enddate) - strtotime(date('Y-m-d H:i:s')))/86400);
if($days >=1)
{
    try{
        $sql = 'INSERT INTO rental_order(user_id, product_id, order_date, order_end_date, rental_price) VALUES(:user_id, :product_id, :order_date, :order_end_date,:rental_price)';
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':user_id', $_SESSION['user_id']);
        $stmt->bindValue('product_id',$_POST['product_id']);
        $stmt->bindValue(':order_date', date('Y-m-d 0:0:0'));
        $stmt->bindValue('order_end_date', $enddate);
        $price = $days * $_POST['rental_price'];
        $stmt->bindValue('rental_price', $price);
        $stmt->execute();

        $sql = 'UPDATE product SET is_in_stock = 0 where id=:id';
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $_POST['product_id']);
        $stmt->execute();

        $_SESSION['msg'] = "Товар арендован.";

    }catch (PDOException $error) {
        $_SESSION['msg'] = "Ошибка: " . $error->getMessage();
    }
}
else
{
    $_SESSION['msg'] = "Ошибка: Неверно выбрана дата окончания аренды.";
}

header("Location: ".$_SERVER['HTTP_REFERER']);
exit();