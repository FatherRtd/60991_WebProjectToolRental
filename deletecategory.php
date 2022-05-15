<?php
    require "dbconnect.php";

    try{
        $sql = 'DELETE FROM category WHERE id=:id';
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $_SESSION['msg'] = "Категория удалена.";

    }catch (PDOException $error){
        $_SESSION['msg'] = "Ошибка: ".$error->getMessage();
    }
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();