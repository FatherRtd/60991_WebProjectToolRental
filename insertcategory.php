<?php
    require "dbconnect.php";

    if(strlen($_GET['name']) >= 3)
    {
        try{
            $sql = 'INSERT INTO category(name, description, parent_id) VALUES(:name, :description, :parent_id)';
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':name', $_GET['name']);
            $stmt->bindValue(':description', $_GET['description']);
            $stmt->bindValue(':parent_id', $_GET['parent_id'] != 'NULL'? $_GET['parent_id'] : Null);
            $stmt->execute();

            $_SESSION['msg'] = "Категория добавлена.";

        }catch (PDOException $error) {
            $_SESSION['msg'] = "Ошибка: " . $error->getMessage();
        }
    }
    else
    {
        $_SESSION['msg'] = "Ошибка: Имя категории должно содержать не менее 3х символов.";
    }

    header('Location:https://toolrentalproject.herokuapp.com/index.php');
    exit();
