<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Личный кабинет</title>
</head>

<body>
    <header>
        <div class="container">
            <h1 class="intro">
                С возвращением,
                <?php
                session_start();
                echo $_SESSION['username'];
                ?>
            </h1>
            <a href="logout.php" class="button-logout">Выйти</a>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="lab1.php">Лабораторная работа №1</a></li>
            <li><a href="lab2.php">Лабораторная работа №2</a></li>
        </ul>
    </nav>

    <main>
    </main>

    <footer>
        <p>Все права защищены &copy; 2023</p>
    </footer>
</body>

</html>