<?php
    require "dbconnect.php";
    require "auth.php";
    require "login_menu.php";
    switch ($_GET['page']) {
        case 'product':
            require "productpage.php";
            break;
        case 'orders':
            require "orderspage.php";
            break;
        case 'admin':
            require "adminpage.php";
            break;
        case 'main':
            require "categories.php";
            require "product.php";
            break;
        default:
            require "categories.php";
            require "product.php";
            break;
    }
    require "message.php";
    $_SESSION['msg'] = '';