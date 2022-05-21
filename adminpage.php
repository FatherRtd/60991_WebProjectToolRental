<div style="margin: 80px auto; width: 80%; display: flex; flex-direction: column;">
    <?php if(isset($_SESSION['login']) && $_SESSION['is_admin'] == 1):?>
        <h1>Добавление категории</h1>
        <form method="get" action="insertcategory.php">
            <div class="mb-3">
                <label for="catName" class="form-label">Название категории</label>
                <input type="text" class="form-control" id="catName" name="name">
            </div>
            <div class="mb-3">
                <label for="catSelect" class="form-label">Родительская категория</label>
                <select id="catSelect" class="form-select" name="parent_id">
                    <option value="NULL">NULL</option>
                    <?php
                    $result = $conn->query("SELECT * FROM category");
                    while($row = $result->fetch())
                    {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    <?php endif ?>
    <?php if(isset($_SESSION['login']) && $_SESSION['is_admin'] == 1):?>
        <h1>Добавление товара</h1>
        <form method="post" action="insertproduct.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="prodName" class="form-label">Название</label>
                <input type="text" class="form-control" id="prodName" name="name">
            </div>
            <div class="mb-3">
                <label for="prodShortDescription" class="form-label">Краткое описание</label>
                <input type="text" class="form-control" id="prodShortDescription" name="short_description">
            </div>
            <div class="mb-3">
                <label for="prodDescription" class="form-label">Описание</label>
                <input type="text" class="form-control" id="prodDescription" name="description">
            </div>
            <div class="mb-3">
                <label for="prodPrice" class="form-label">Стоимость аренды</label>
                <input type="text" class="form-control" id="prodPrice" name="rental_price">
            </div>
            <div class="mb-3">
                <label for="prodSelect" class="form-label">Родительская категория</label>
                <select id="prodSelect" class="form-select" name="is_in_stock">
                    <option value="1">В наличии</option>
                    <option value="0">Нет в наличии</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="prodSelect" class="form-label">Родительская категория</label>
                <select id="prodSelect" class="form-select" name="category_id">
                    <?php
                    $result = $conn->query("SELECT * FROM category WHERE parent_id >= 0");
                    while($row = $result->fetch())
                    {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="input-text" for="prodImage">Загрузить</label>
                <input type="file" class="form-control" id="prodImage" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    <?php endif ?>
</div>