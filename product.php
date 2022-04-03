<div style="display: flex; margin-top: 80px">
    <div style="width: 30%">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Элемент аккордеона #1
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>123</strong>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Элемент аккордеона #2
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>123</strong>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Элемент аккордеона #3
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>123</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="width: 70%">
        <h1 style="text-align: center">Инструменты</h1>
        <table class="table" style="width: 80%; margin: 0 auto">
            <tr>
                <th>id</th>
                <th>Название</th>
                <th>Краткое описание</th>
                <th>Описание</th>
                <th>Стоимость аренды</th>
                <th>Минимальное время аренды</th>
                <th>В наличии</th>
                <th>Категория</th>
                <th>Изображение</th>
                <?php if(isset($_SESSION['login']) && $_SESSION['is_admin'] == 1):?>
                    <th>Удалить товар</th>
                <?php endif?>
            </tr>
            <?php
            $result = $conn->query("SELECT product.id pID, product.name pName, product.short_description pSD, product.long_description pLD, product.rental_price pRP, product.is_in_stock pIIS, product.min_rental_time pMRT, product.image pImg, category.name cName FROM product, category WHERE product.category_id = category.id");
            while($row = $result->fetch())
            {
                echo $row['pI'];
                echo '<td>' . $row['pID'] . '</td><td>' . $row['pName'] . '</td><td>' . $row['pSD'] . '</td>';
                echo '<td>' . $row['pLD'] . '</td><td>' . $row['pRP'] . '</td><td>' . $row['pMRT']. '</td>';
                echo '<td>' . $row['pIIS'] . '</td><td>' . $row['cName'] . '</td><td><img src="' . $row['pImg']. '"/></td>';
                if(isset($_SESSION['login']) && $_SESSION['is_admin'] == 1)
                    echo '<td><a href=deleteproduct.php?id=' . $row['pID'] . '>Удалить</a><td/>';
                echo '</tr>';
            }
            ?>
        </table>
        <?php if(isset($_SESSION['login']) && $_SESSION['is_admin'] == 1):?>
            <h1>Добавление товара</h1>
            <form method="get" action="insertproduct.php">
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
                <input type="text" placeholder="Изображение" name="image">
                <input type="submit" value="Добавить">
            </form>
        <?php endif ?>
    </div>
</div>
