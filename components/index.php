<?php require './header.php' ?>

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
                            <form action="./process-login.php" method="post">
                                <span class="error-message"><?= @$loginError; ?></span>
                                <div class="form-group">
                                    <label for="username">Логин:</label>
                                    <input type="text" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Пароль:</label>
                                    <input type="password" id="password" name="password" required>
                                    <div id="passwordError" class="error-message"></div>
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Повторите пароль:</label>
                                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                                    <div id="passwordError" class="error-message"></div>
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