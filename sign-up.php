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
    $stmt->execute(['username' => $username]);
    $row = $stmt->fetch();
    if ($row) {
        header("Location: /user_already_exist.html", true, 301);
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO php_db.users (username, email, password) 
                                    VALUES (:username, :email, :password)");

    $fp = fopen('/dev/urandom', 'r');
    $randomBytes = fread($fp, 24);
    fclose($fp);
    $salt = base64_encode($randomBytes);
    $hashed_password = '10000$' . $salt . '$' . hash_pbkdf2('sha384', $password, $salt, 10000);

    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'password' => $hashed_password
    ]);



