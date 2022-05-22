<?php
require "dbconnect.php";


if(strlen($_GET['login']) >=3 && strlen($_GET['name']) >=3 && strlen($_GET['surname']) >=3 && strlen($_GET['password']) >=3)
{
    $isLoginBusy = false;
    $result = $conn->query("SELECT login FROM user");
    while($row = $result->fetch())
    {
        if($_GET['login'] == $row['login'])
            $isLoginBusy = true;
    }

    if(!$isLoginBusy)
    {
        try{
            $sql = 'INSERT INTO user(firstname, lastname, login, md5password) VALUES(:name, :surname, :login, :password)';
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':name', $_GET['name']);
            $stmt->bindValue(':surname', $_GET['surname']);
            $stmt->bindValue(':login', $_GET['login']);
            $stmt->bindValue(':password', MD5($_GET['password']));
            $stmt->execute();

            $_SESSION['msg'] = "Регистрация завершена.";

        }catch (PDOException $error) {
            $_SESSION['msg'] = "Ошибка: " . $error->getMessage();
            header('Location:index.php?page=registration');
            exit();
        }
    }
    else
    {
        $_SESSION['msg'] = "Ошибка: Логин занят.";
        header('Location:index.php?page=registration');
        exit();
    }

}
else
{
    $_SESSION['msg'] = "Ошибка: Неверно заполнены поля.";
    header('Location:index.php?page=registration');
    exit();
}

header('Location:index.php');
exit();

