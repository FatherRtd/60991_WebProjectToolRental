<?php
require "dbconnect.php";

if ($file = fopen($_FILES['image']['tmp_name'], 'r+')){
    //получение расширения
    $ext = explode('.', $_FILES["image"]["name"]);
    $ext = $ext[count($ext) - 1];
    $filename = 'file' . rand(100000, 999999) . '.' . $ext;

    $resource = Container::getFileUploader()->store($file, $filename);
    $picture_url = $resource['ObjectURL'];
    echo $picture_url;
}
else{
    echo "No photo";
}

if(strlen($_POST['name']) >= 3)
{
    try{
        $sql = 'INSERT INTO product(name, short_description, long_description, rental_price, is_in_stock, image, category_id) VALUES(:name, :short_description, :long_description, :rental_price,:is_in_stock,:image,:category_id)';
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':name', $_POST['name']);
        $stmt->bindValue(':short_description', $_POST['short_description']);
        $stmt->bindValue(':long_description', $_POST['description']);
        $stmt->bindValue(':rental_price', $_POST['rental_price']);
        $stmt->bindValue(':is_in_stock', $_POST['is_in_stock']);
        $stmt->bindValue(':image', $picture_url);
        $stmt->bindValue(':category_id', $_POST['category_id']);
        $stmt->execute();

        $_SESSION['msg'] = "Товар добавлен.";

    }catch (PDOException $error) {
        $_SESSION['msg'] = "Ошибка: " . $error->getMessage();
    }
}
else
{
    $_SESSION['msg'] = "Ошибка: Название товара должно содержать не менее 3х символов.";
}

header('Location:index.php');
exit();
