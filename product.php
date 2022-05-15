<div style="display: flex; margin-top: 80px">
    <div style="width: 100%;">
        <h1 style="text-align: center">Инструменты</h1>
        <div style="display: grid; grid-template-columns: repeat(4, 300px); grid-column-gap: 20px; grid-row-gap: 20px; justify-content: center">
            <?php
            $result = $conn->query("SELECT product.id pID, product.name pName, product.short_description pSD, product.long_description pLD, product.rental_price pRP, product.is_in_stock pIIS, product.image pImg, category.name cName FROM product, category WHERE product.category_id = category.id and product.is_in_stock = 1");
            while($row = $result->fetch())
            {
                echo '<div class="card" style="width: 300px;">';
                echo '<a href="http://toolrental/index.php?page=product&id='.$row['pID'].'">';
                echo '<img src="'. $row['pImg'].'" class="card-img-top" style="height: 300px" alt="..."></a>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$row['pName'].'</h5>';
                echo '<p class="card-text">'.$row['pSD'].'</p>';
                if(isset($_SESSION['login']) && $_SESSION['is_admin'] == 1)
                    echo '<a class="btn btn-primary" style="width: 100px" href=deleteproduct.php?id='. $row['pID'].'>Удалить</a>';
                echo '</div></div>';
            }
            ?>
        </div>
        <?php if(isset($_SESSION['login']) && $_SESSION['is_admin'] == 1):?>
            <h1>Добавление товара</h1>
            <form method="post" action="insertproduct.php" enctype="multipart/form-data">
                <input type="text" placeholder="Название" name="name">
                <input type="text" placeholder="Краткое описание" name="short_description">
                <input type="text" placeholder="Описание" name="description">
                <input type="text" placeholder="Стоимость аренды" name="rental_price">
                <input type="text" placeholder="Минимальное время аренды" name="min_rental_time">
                <select name="is_in_stock">
                    <option value="1">В наличии</option>
                    <option value="0">Нет в наличии</option>
                </select>
                <select name="category_id">
                    <?php
                    $result = $conn->query("SELECT * FROM category WHERE parent_id >= 0");
                    while($row = $result->fetch())
                    {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    ?>
                </select>
                <input type="file" placeholder="Изображение" name="image">
                <input type="submit" value="Добавить">
            </form>
        <?php endif ?>
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
    </div>
</div>
