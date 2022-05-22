<div style="margin: 80px auto; width: 20%; display: flex; flex-direction: column;">
        <h1>Регистрация</h1>
        <form method="get" action="insertuser.php">
            <div class="mb-3">
                <label for="userName" class="form-label">Имя</label>
                <input type="text" class="form-control" id="catName" name="name">
            </div>
            <div class="mb-3">
                <label for="userSurname" class="form-label">Фамилия</label>
                <input type="text" class="form-control" id="userSurname" name="surname">
            </div>
            <div class="mb-3">
                <label for="userLogin" class="form-label">Логин</label>
                <input type="text" class="form-control" id="userLogin" name="login">
            </div>
            <div class="mb-3">
                <label for="userPassword" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="userPassword" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Зарегестрироваться</button>
        </form>
</div>
