<?php
    require "dbconnect.php";

    try{
        $sql = 'DELETE FROM rental_order WHERE id=:id';
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $_SESSION['msg'] = "Заказ удалена.";

    }catch (PDOException $error){
        $_SESSION['msg'] = "Ошибка: ".$error->getMessage();
    }
    header('Location:index.php?page=orders');
    exit();
