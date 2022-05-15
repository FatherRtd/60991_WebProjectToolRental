<div style="display: flex; margin-top: 80px">
    <div style="width: 20%">
        <div class="accordion" id="accordionExample">

        <?php
            $result = $conn->query("SELECT * FROM category");
            while($row = $result->fetch())
            {
                echo '<div class="accordion-item">';
                echo '<h2 class="accordion-header" id="heading'.$row['id'].'">';
                echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$row['id'].'" aria-expanded="true" aria-controls="collapse'.$row['id'].'">';
                echo $row['name'].'</button></h2>';
                echo '<div id="collapse'.$row['id'].'" class="accordion-collapse collapse show" aria-labelledby="heading'.$row['id'].'" data-bs-parent="#accordionExample">';
                echo '<div class="accordion-body">';
                echo '<strong>'.$row['description'].'</strong>';
                if(isset($_SESSION['login']) && $_SESSION['is_admin'] == 1)
                    echo '<a class="btn btn-outline-success my-2 my-sm-0" href=deletecategory.php?id=' . $row['id'] . '>Удалить</a>';
                echo '</div></div></div>';

            }
        ?>
        </div>
    </div>

