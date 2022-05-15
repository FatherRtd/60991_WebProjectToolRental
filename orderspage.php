<?php
require "dbconnect.php";
?>
<div style="width: 80%; display: flex; flex-direction: column; margin: 80px auto;">
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Название товара</th>
            <th scope="col">Начало аренды</th>
            <th scope="col">Окончание аренды</th>
            <th scope="col">Стоимость аренды</th>
        </tr>
        </thead>
        <?php
            $result = $conn->query("SELECT p.name product_name, ro.order_date order_date, ro.order_end_date order_end_date, ro.rental_price FROM rental_order ro JOIN product p on ro.product_id = p.id WHERE ro.user_id =".$_SESSION['user_id']);
            while($row = $result->fetch())
            {
                echo '<tbody><tr>';
                echo '<th scope="row">'.$row['product_name'].'</th>';
                echo '<td>'.$row['order_date'].'</td>';
                echo '<td>'.$row['order_end_date'].'</td>';
                echo '<td>'.$row['rental_price'].'</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
</div>
