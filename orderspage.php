<?php
require "dbconnect.php";
?>
<div style="width: 80%; display: flex; flex-direction: column; margin: 80px auto;">
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Название товара</th>
            <?php
                if ($_SESSION['is_admin'] == 1)
                {
                    echo '<th scope="col">Имя</th>';
                    echo '<th scope="col">Фамилия</th>';
                }
            ?>
            <th scope="col">Начало аренды</th>
            <th scope="col">Окончание аренды</th>
            <th scope="col">Стоимость аренды</th>
            <th scope="col">Статус</th>
            <th scope="col">Завершить</th>
        </tr>
        </thead>
        <?php
        try {
            if ($_SESSION['is_admin'] == 1) {
                $result = $conn->query("SELECT ro.id roID, u.firstname uName, u.lastname uSurname, p.name product_name, p.rental_price pPrice, ro.order_date order_date, ro.order_end_date order_end_date, ro.rental_price, ro.is_done is_done 
                                                    FROM rental_order ro 
                                                        JOIN product p on ro.product_id = p.id
                                                        JOIN user u on ro.user_id = u.id");
            } else {
                $result = $conn->query("SELECT ro.id roID, p.name product_name,p.rental_price pPrice, ro.order_date order_date, ro.order_end_date order_end_date, ro.rental_price, ro.is_done is_done 
                                                    FROM rental_order ro 
                                                        JOIN product p on ro.product_id = p.id WHERE ro.user_id =" . $_SESSION['user_id']);
            }

            while ($row = $result->fetch()) {
                $days = ceil((strtotime(date('Y-m-d H:i:s')) - strtotime(date('Y-m-d H:i:s',strtotime($row['order_date']))))/86400);
                $price = $row['pPrice'] * $days;
                echo '<tbody><tr>';
                echo '<th scope="row">' . $row['product_name'] . '</th>';
                if ($_SESSION['is_admin'] == 1)
                {
                    echo '<td>' . $row['uName'] . '</td>';
                    echo '<td>' . $row['uSurname'] . '</td>';
                }
                echo '<td>' . $row['order_date'] . '</td>';
                echo '<td>' . $row['order_end_date'] . '</td>';

                if ($row['is_done'] == 1) {
                    echo '<td>' . $row['rental_price'] . '</td>';
                    echo '<td>Завершён</td>';
                    echo '<td><a class="btn btn-primary" style="width: 100px" href=deleteorder.php?id=' . $row['roID'] . '>Удалить</a></td>';
                } else {
                    echo '<td>' . $price . '</td>';
                    echo '<td>В процессе</td>';
                    echo '<td><a class="btn btn-primary" style="width: 100px" href=completeorder.php?id=' . $row['roID'] . '>Завершить</a></td>';
                }
                echo '</tr>';
            }
        }
        catch (PDOException $error){
            $_SESSION['msg'] = "Ошибка: ".$error->getMessage();
        }
        ?>
        </tbody>
    </table>
</div>
