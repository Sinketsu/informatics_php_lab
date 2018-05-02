<?php
    $user = "root";
    $pass = "swordart1337";
    $dsn = "mysql:host=localhost;dbname=php_db";
    $opt = [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);
    $stmt = $pdo->prepare('SELECT * FROM users');
    $stmt->execute();
    foreach ($stmt as $row) {
        print $row['password'] . "\n";
    }
