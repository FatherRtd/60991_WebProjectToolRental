<?php
    if(isset($_GET['logout']))
    {
        setcookie("firstname","ben",time()-999999);
    }
    if(isset($_GET['login']))
    {
        setcookie("firstname",$_GET['login'],time()+15000);
    }
    if(isset($_COOKIE['firstname']))
    {
        echo ('Привет, '.$_COOKIE['firstname'].'!');
        echo ('<a href=cookie.php?logout>Выйти<a>');
    }
    else
    {
        echo ('<a href=cookie.php?login=ben>Войти<a>');
    }