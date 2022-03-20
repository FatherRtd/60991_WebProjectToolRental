<?php

    if(isset($_POST["login"]) and $_POST["login"]!='')
    {
        try{
            $sql = "SELECT firstname, lastname, md5password FROM user WHERE login=(:login)";
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':login', $_POST['login']);
            $stmt->execute();
            //$_SESSION['msg'] = "Вы успешно вошли в систему.";

        }catch (PDOException $error) {
            $msg = "Ошибка аутентификации: " . $error->getMessage();
        }

        if($row=$stmt->fetch(PDO::FETCH_LAZY))
        {
            if(MD5($_POST["password"]) != $row['md5password']) $_SESSION['msg'] = "Неверный пароль!";
            else
            {
                $_SESSION['login'] = $_POST["login"];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['msg'] = "Вы успешно вошли в систему.";
            }
        }
        else $msg = "Неверное имя пользователя!";
    }

    if(isset($_GET["logout"]))
    {
        session_unset();
        $_SESSION['msg'] = "Вы вышли из системы.";
        header('Location:http://toolrental');
        exit();
    }