<?php
require "dbconnect.php";
$price = 0;
$productID = 0;
try{
    $result = $conn->query("SELECT p.id pID, p.rental_price rental_price, ro.order_date order_date FROM rental_order ro JOIN product p on ro.product_id = p.id WHERE ro.id = ".$_GET['id']);
    while($row = $result->fetch())
    {
        $days = ceil((strtotime(date('Y-m-d H:i:s')) - strtotime(date('Y-m-d H:i:s',strtotime($row['order_date']))))/86400);
        $price = $row['rental_price'] * $days;
        $productID = $row['pID'];
    }
    $sql = 'UPDATE rental_order SET order_end_date = :end_date, rental_price = :price, is_done = :done WHERE id=:id';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->bindValue(':end_date', date('Y-m-d H:i:s'));
    $stmt->bindValue(':done', 1);
    $stmt->bindValue(':price', $price);
    $stmt->execute();
    $sql = 'UPDATE product SET is_in_stock = 1 WHERE id=:pID';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':pID', $productID);
    $stmt->execute();
    $_SESSION['msg'] = "Заказ завершён.";

}catch (PDOException $error){
    $_SESSION['msg'] = "Ошибка: ".$error->getMessage();
}
header('Location:index.php?page=orders');
exit();
