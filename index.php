<?php
    require "dbconnect.php";

    echo ("<table border='1'>");
    $result = $conn->query("SELECT * FROM category");
    while($row = $result->fetch())
    {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td><td>' . $row['name'] . '</td><td>' . $row['description'] . '</td>';
        $parent_name = $conn->query("SELECT name FROM category WHERE id ='{$row['parent_id']}'");
        $row1 = $parent_name->fetch();
        echo '<td>'.$row1['name'].'</td>';
        echo '<td><a href=deletecategory.php?id=' . $row['id'] . '>Удалить</a><td/>';
        echo '</tr>';
    }
    echo ("</table>");
?>

<h1>Добавление категории</h1>
<form method="get" action="insertcategory.php">
    <input type="text" name="name">
    <input type="text" name="description">
    <select name="parent_id">
        <option value="NULL">NULL</option>
        <?php
        $result = $conn->query("SELECT * FROM category");
        while($row = $result->fetch())
        {
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Добавить">
</form>