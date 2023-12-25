<?php

include "../database/db.php";

$username = $_POST["username"];
$password = $_POST["password"];

$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($connect, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password . $row['salt'], $row['password'])) {
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['fullname'];
        header('Location: main.php'); 
    } else {
        $loginError .= 'ERROR';
        header('Location: index.php'); 
    }
} else {
    $loginError .= 'ERROR 1';
    header('Location: index.php'); 
}
$conn->close();
