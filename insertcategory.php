<?php
    require "dbconnect.php";

    if(strlen($_GET['name']) >= 3)
    {
        try{
            $sql = 'INSERT INTO category(name, parent_id) VALUES(:name, :parent_id)';
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':name', $_GET['name']);
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

    header('Location:index.php');
    exit();
