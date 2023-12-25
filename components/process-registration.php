<?php
if (isset($_POST['captcha'])) {
    session_start();
    if (isset($_SESSION['captcha_result']) && intval($_SESSION['captcha_result']) == $_POST['captcha']) {
        include "../database/db.php";
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];

        $salt = random_bytes(22);
        $salt = base64_encode($salt);

        $hashedPassword = password_hash($password . $salt, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (fullname, username, email, password, phone, gender, salt) 
            VALUES ('$fullname', '$username', '$email', '$hashedPassword', '$phone', '$gender', '$salt')";

        if ($connect->query($sql) === true)
            Header("Location: index.php");
        else Header("Location: registration.php");
    } else
        Header("Location: registration.php");
    unset($_SESSION['captcha']);
    exit();
}
