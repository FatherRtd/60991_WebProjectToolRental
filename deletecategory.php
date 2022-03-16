<?php
    require "dbconnect.php";

    try{
        $sql = 'DELETE FROM category WHERE id=:id';
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        echo("Категория удалена.");

    }catch (PDOException $error){
        echo ("Ошибка: ".$error->getMessage());
    }
    header('Location:http://toolrental');
    exit();
