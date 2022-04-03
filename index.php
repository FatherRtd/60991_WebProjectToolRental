<?php
    require "dbconnect.php";
    require "auth.php";
    require "login_menu.php";
    switch ($_GET['page'])
    {
        case 'cat':
            require "categories.php";
            break;
        case 'prod':
            require "product.php";
            break;
    }
    require "message.php";
    $_SESSION['msg'] = '';