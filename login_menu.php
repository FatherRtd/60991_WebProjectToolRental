<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
    <header class="container">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-black" style="min-height: 70px">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php?page=main">ToolRental</a> <!--toolrentalproject.herokuapp.com/-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <?php
                                if(isset($_SESSION['login']))
                                    echo '<a class="nav-link" href="index.php?page=orders">Товары в аренде</a>';
                            ?>
                        </li>
                    </ul>

                    <?php
                    if(!isset($_SESSION['login']))
                    {
                        echo "<form class='d-flex' method='post'>";
                        echo "<input class='form-control me-2' placeholder='Имя пользователя' type='text' name='login'/></br>";
                        echo "<input class='form-control me-2' placeholder='Пароль' type='password' name='password'/></br>";
                        echo "<input type='submit' value='Войти'>";
                        echo "</form>";
                    }
                    else
                    {
                        echo '<a class="nav-link" style="color: white" href="#">Привет, '.$_SESSION['firstname'].' '.$_SESSION['lastname'].'</a>';
                        echo '<a class="btn btn-outline-success my-2 my-sm-0" href="?logout=1">Выйти</a>';
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>
