
    <div style="width: 80%;">
        <h1 style="text-align: center">Инструменты</h1>
        <div style="display: grid; grid-template-columns: repeat(4, 300px); grid-column-gap: 20px; grid-row-gap: 20px; justify-content: center">
            <?php
            if(isset($_GET['id']))
                $result = $conn->query("SELECT product.id pID, product.name pName, product.short_description pSD, product.long_description pLD, product.rental_price pRP, product.is_in_stock pIIS, product.image pImg, category.name cName FROM product, category WHERE product.category_id = category.id and (product.category_id=".$_GET['id']." OR category.parent_id=".$_GET['id'].") and product.is_in_stock = 1");
            else
                $result = $conn->query("SELECT product.id pID, product.name pName, product.short_description pSD, product.long_description pLD, product.rental_price pRP, product.is_in_stock pIIS, product.image pImg, category.name cName FROM product, category WHERE product.category_id = category.id and product.is_in_stock = 1");
            while($row = $result->fetch())
            {
                echo '<div class="card" style="width: 300px;">';
                echo '<a href="index.php?page=product&id='.$row['pID'].'">';
                echo '<img src="'. $row['pImg'].'" class="card-img-top" style="height: 300px" alt="..."></a>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$row['pName'].'</h5>';
                echo '<p class="card-text">Категория: '.$row['cName'].'</p>';
                echo '<p class="card-text">'.$row['pSD'].'</p>';
                if(isset($_SESSION['login']) && $_SESSION['is_admin'] == 1)
                    echo '<a class="btn btn-primary" style="width: 100px" href=deleteproduct.php?id='. $row['pID'].'>Удалить</a>';
                echo '</div></div>';
            }
            ?>
        </div>
    </div>
</div>
