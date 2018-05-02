<?php
    $user = "root";
    $pass = "swordart1337";
    $dsn = "mysql:host=localhost;dbname=php_db";
    $opt = [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT username FROM users WHERE username = :username');
    $stmt->execute([$username]);
    if ($row = $stmt->fetch()) {
        print 'exist!';
    } else {
        print 'not exist!';
    }
