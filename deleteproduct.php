<?php
require "dbconnect.php";

try{
    $result = $conn->query("SELECT * FROM product WHERE id=".$_GET['id']);
    $row = $result->fetch();
    try {
        $resource = Container::getFileUploader()->delete($row['image']);
    } catch (S3Exception $e) {
        $_SESSION['msg'] = $e->getMessage();
    }

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