<?php
    include_once 'utils/dbworker.php';
    include_once 'utils/auth.php';
    include_once 'utils/csrf.php';

    check_csrf();

    if ($_SERVER['REQUEST_METHOD'] != 'POST' or !isset($_POST['username']) or !isset($_POST['password']) or
        !isset($_POST['email'])){
        header("Location: /error/bad_request.html", true, 303);
        exit();
    }

    $pdo = get_PDO();

    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT username
                                    FROM users
                                    WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $row = $stmt->fetch();
    if ($row) {
        header("Location: /error/user_already_exist.html", true, 303);
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

    $cookie = login($username);
    setcookie('sess_id', $cookie, time() + 60*60*24*14, '', '', true, true);

    header("Location: /", true, 303);
    exit();
