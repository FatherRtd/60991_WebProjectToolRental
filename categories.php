<h1 style="margin: 80px; text-align: center">Категории инструментов:</h1>
<table class="table" style="width: 80%; margin: 0 auto">
    <tr>
        <th>id</th>
        <th>Название категории</th>
        <th>Описание</th>
        <th>Родительская категория</th>
        <?php if(isset($_SESSION['login']) && $_SESSION['is_admin'] == 1):?>
        <th>Удалить категорию</th>
        <?php endif?>
    </tr>
    <?php
        $result = $conn->query("SELECT * FROM category");
        while($row = $result->fetch())
        {

            echo '<td>' . $row['id'] . '</td><td>' . $row['name'] . '</td><td>' . $row['description'] . '</td>';
            $parent_name = $conn->query("SELECT name FROM category WHERE id ='{$row['parent_id']}'");
            $row1 = $parent_name->fetch();
            echo '<td>'.$row1['name'].'</td>';
            if(isset($_SESSION['login']) && $_SESSION['is_admin'] == 1)
                echo '<td><a href=deletecategory.php?id=' . $row['id'] . '>Удалить</a><td/>';
            echo '</tr>';
        }
    ?>
</table>

<?php if(isset($_SESSION['login']) && $_SESSION['is_admin'] == 1):?>
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
<?php endif ?>
