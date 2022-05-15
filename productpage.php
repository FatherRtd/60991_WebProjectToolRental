<?php
    require "dbconnect.php";
?>

<?php
    $result = $conn->query("SELECT * from product where id=".$_GET['id']);
    $row = $result->fetch();
?>
<div style="width: 80%; display: flex; flex-direction: column; margin: 70px auto;">
    <div style="margin: 0 auto">
        <h1><?php echo $row['name']?></h1>
    </div>
    <div style="margin-top: 20px; display: flex">
        <img src="<?php echo $row['image']?>" style="height: 300px">
        <div style="margin-left: 20px">
            <h3>Цена аренды: <?php echo $row['rental_price']?>руб</h3>
            <h3>Минимальный срок аренды: <?php echo $row['min_rental_time']?> день</h3>
            <form method="post" action="insertorder.php" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?php echo $row['id']?>">
                <input type="hidden" name="rental_price" value="<?php echo $row['rental_price']?>">
                <label for="endDate">Арендовать до</label>
                <input id="endDate" class="form-control" type="date" name="end_date"/>
                <input type="submit" value="Арендовать">
            </form>
        </div>
    </div>
    <div style="margin-top: 20px">
        <h3>
            <?php echo $row['long_description']?>
        </h3>
    </div>
</div>
