<?php
require "dbconnect.php";

try{
    $sql = 'DELETE FROM product WHERE id=:id';
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $_SESSION['msg'] = "Товар удален.";

}catch (PDOException $error){
    $_SESSION['msg'] = "Ошибка: ".$error->getMessage();
}
header('Location:http://toolrental/index.php?page=prod');
exit();