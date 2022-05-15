<?php

    if(isset($_POST["login"]) and $_POST["login"]!='')
    {
        try{
            $sql = "SELECT id , firstname, lastname, md5password, is_admin FROM user WHERE login=(:login)";
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':login', $_POST['login']);
            $stmt->execute();

        }catch (PDOException $error) {
            $_SESSION['msg'] = "Ошибка аутентификации: " . $error->getMessage();
        }

        if($row=$stmt->fetch())
        {
            if(MD5($_POST["password"]) != $row['md5password']) $_SESSION['msg'] = "Неверный пароль!";
            else
            {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['login'] = $_POST["login"];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['is_admin'] = $row['is_admin'];
                $_SESSION['msg'] = "Вы успешно вошли в систему.";
            }
        }
        else $_SESSION['msg'] = "Неверное имя пользователя!";
    }

    if(isset($_GET["logout"]))
    {
        session_unset();
        $_SESSION['msg'] = "Вы вышли из системы.";
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    }