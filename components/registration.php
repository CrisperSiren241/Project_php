<?php require '../components/header.php' ?>

<?php

function clearString($str)
{
    $str = trim($str);
    $str = strip_tags($str);
    $str = stripslashes($str);
    return $str;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../database/db.php";
    session_start();


    $fioError = "";
    $loginError = "";
    $emailError = "";
    $passError = "";
    $passConfirmError = "";
    $phoneError = "";
    $genderError = "";
    $captchaError = "";

    $name = clearString($_POST['fullname']);
    $login = clearString($_POST['username']);
    $email = clearString($_POST['email']);
    $pass = clearString($_POST['pass']);
    $passConfirm = clearString($_POST['passConfirm']);
    $phone = clearString($_POST['phone']);
    $gender = clearString($_POST['gender']);
    $captcha = clearString($_POST['captcha']);

    $readyToRegister = true;

    if (empty($name)) {
        $nameError = 'Это поле не может быть пустым!';
        $readyToRegister = false;
    } else if (!preg_match('/^[A-Za-zА-Яа-яЁё\s\-]+$/iu', $name)) {
        $nameError .= "Введенные ФИО не соответствует требованиям";
        $readyToRegister = false;
    }

    $result = $connect->query("SELECT * FROM USERS WHERE username=" . $login);
    if (empty($login)) {
        $loginError = 'Это поле не может быть пустым!';
        $readyToRegister = false;
    } else if (mysqli_num_rows($result) > 0) {
        $loginError = 'Такой пользователь уже зарегистрирован!';
        $readyToRegister = false;
    } else if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $login)) {
        $loginError = "Введенный логин не соответствует требованиям";
        $readyToRegister = false;
    }

    if (empty($email)) {
        $emailError = 'Это поле не может быть пустым!';
        $readyToRegister = false;
    } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
        $emailError = "Введенный Email не соответствует требованиям";
        $readyToRegister = false;
    }

    if (empty($pass)) {
        $passError = 'Это поле не может быть пустым!';
        $readyToRegister = false;
    } else if ($pass != $passConfirm) {
        $passConfirmError = 'Пароли не совпадают!';
        $readyToRegister = false;
    }

    if (empty($phone)) {
        $phoneError = 'Это поле не может быть пустым!';
        $readyToRegister = false;
    } else if (!preg_match('/^\+\d{1,3}\s?\d{1,4}\s?\d{1,10}$/', $phone)) {
        $phoneError = "Введенный номер телефона не соответствует требованиям";
        $readyToRegister = false;
    }

    if (empty($gender)) {
        $genderError = 'Это поле не может быть пустым!';
        $readyToRegister = false;
    }

    if (empty($captcha)) {
        $captchaError = 'Это поле не может быть пустым!';
        $readyToRegister = false;
    } else if ($_SESSION['captcha'] != $captcha) {
        $captchaError = 'Неправильно введена капча!';
        $readyToRegister = false;
    }


    if ($readyToRegister) {

        $salt = random_bytes(22);
        $salt = base64_encode($salt);

        $hashedPassword = password_hash($pass . $salt, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (fullname, username, email, password, phone, gender, salt) 
        VALUES ('$name', '$login', '$email', '$hashedPassword', '$phone', '$gender', '$salt')";
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
                                <form id="registrationForm" method="post" onsubmit="return validateForm()">
                                    <div class="form-group">
                                        <label for="fullname">ФИО:</label>
                                        <input type="text" id="fullname" name="fullname" required>
                                        <span class="error-message"><?= @$fioError; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Логин:</label>
                                        <input type="text" id="username" name="username" required>
                                        <span class="error-message"><?= @$loginError; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" required>
                                        <span class="error-message"><?= @$emailError; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Пароль:</label>
                                        <input type="password" id="password" name="pass" required>
                                        <span class="error-message"><?= @$passError; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword">Повторите пароль:</label>
                                        <input type="password" id="confirmPassword" name="passConfirm" required>
                                        <span class="error-message"><?= @$passConfirmError; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Номер телефона:</label>
                                        <input type="tel" id="phone" name="phone" required>
                                        <span class="error-message"><?= @$phoneError; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Пол:</label>
                                        <select id="gender" name="gender" required>
                                            <option value="female">Женский</option>
                                            <option value="male">Мужской</option>
                                        </select>
                                        <span class="error-message"><?= @$genderError; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <img src='captcha.php' id='captcha-image'>
                                        <br>&emsp;&emsp;
                                        <a href="javascript:void(0);" onclick="document.getElementById('captcha-image').src='captcha.php?rid=' + Math.random();">Обновить
                                            капчу</a>
                                        <br>
                                        <br>&nbsp;
                                        <label>Введите код с капчи:</label>
                                        <input type="text" name="captcha" /><br />
                                        <span class="error-message"><?= @$captchaError; ?></span>
                                        <br>&emsp;&emsp;&emsp;
                                    </div>


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