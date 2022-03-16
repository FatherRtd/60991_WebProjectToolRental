<?php
    require "dbconnect.php";

    try{
        $sql = 'INSERT INTO category(name, description, parent_id) VALUES(:name, :description, :parent_id)';
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':name', $_GET['name']);
        $stmt->bindValue(':description', $_GET['description']);

        if($_GET['parent_id'] != 'NULL')
        {
            $stmt->bindValue(':parent_id', $_GET['parent_id']);
        }
        else
        {
            $stmt->bindValue(':parent_id', Null);
        }
        $stmt->execute();
        echo("Категория добавлена.");

    }catch (PDOException $error) {
        echo("Ошибка: " . $error->getMessage());
    }
    header('Location:http://toolrental');
    exit();
