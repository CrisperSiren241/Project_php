<?php require '../components/header.php' ?>

<body>
    <div class="wrap">
        <div class="smh">
            <div class="loginFrom">
                <div class="login__header">
                    <div class="loginForm__container">
                        <div class="loginForm__header__inner">
                            <nav>
                                <a href="../components/index.php">Вход</a>
                                <a href="./registration.php">Регистрация</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content registration">
                    <div class="loginForm__container">
                        <div class="content__inner">
                            <div class="registration-form">
                                <h1>Регистрация</h1>
                                <form id="registrationForm" action="process-registration.php" method="post" onsubmit="return validateForm()">
                                    <div class="form-group">
                                        <label for="fullname">ФИО:</label>
                                        <input type="text" id="fullname" name="fullname" required>
                                        <div id="fullnameError" class="error-message"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Логин:</label>
                                        <input type="text" id="username" name="username" required>
                                        <div id="usernameError" class="error-message"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" required>
                                        <div id="emailError" class="error-message"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Пароль:</label>
                                        <input type="password" id="password" name="password" required>
                                        <div id="passwordError" class="error-message"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword">Повторите пароль:</label>
                                        <input type="password" id="confirmPassword" name="confirmPassword" required>
                                        <div id="confirmPasswordError" class="error-message"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Номер телефона:</label>
                                        <input type="tel" id="phone" name="phone" required>
                                        <div id="phoneError" class="error-message"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Пол:</label>
                                        <select id="gender" name="gender" required>
                                            <option value="female">Женский</option>
                                            <option value="male">Мужской</option>
                                        </select>
                                    </div>

                                    <img src='captcha.php' id='captcha-image'>
                                    <br>&emsp;&emsp;
                                    <a href="javascript:void(0);" onclick="document.getElementById('captcha-image').src='captcha.php?rid=' + Math.random();">Обновить
                                        капчу</a>
                                    <br>
                                    <br>&nbsp;
                                    <input type="text" name="captcha" /><br />
                                    <br>&emsp;&emsp;&emsp;

                                    <div class="form-group">
                                        <input type="submit" value="Зарегистрироваться">
                                    </div>
                                </form>
                            </div>
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
    <?php require '../components/footer.php' ?>