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
        default:
            require "product.php";
            break;
    }
    require "message.php";
    $_SESSION['msg'] = '';