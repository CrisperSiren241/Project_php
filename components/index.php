<?php require './header.php' ?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include "../database/db.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password . $row['salt'], $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['fullname'];
            header('Location: main.php');
        } else {
            $passError = "Неправильно указан пароль!";
        }
    } else {
        $loginError = "Такого пользователя не существует!";
    }
}


?>

<body>
    <div class="wrap">
        <div class="smh">
            <div class="loginFrom">
                <div class="login__header">
                    <div class="loginForm__container">
                        <div class="loginForm__header__inner">
                            <nav>
                                <a href="./index.php">Вход</a>
                                <a href="./registration.php">Регистрация</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="loginForm__container">
                        <div class="content__inner">
                            <h1>Добро пожаловать!</h1>
                            <form method="post">
                                <div class="form-group">
                                    <label for="username">Логин:</label>
                                    <input type="text" id="username" name="username" required>
                                    <span class="error-message"><?= @$loginError; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Пароль:</label>
                                    <input type="password" id="password" name="password" required>
                                    <span class="error-message"><?= @$passError; ?></span>

                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Войти">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="imageForm">
                <img class="theme" src="../images/background.jpeg" alt="background">
            </div>
        </div>
    </div>
    <script src="./script.js"></script>
</body>
<?php require './footer.php'; ?>