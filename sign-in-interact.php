<?php
    include_once 'utils/dbworker.php';
    include_once 'utils/auth.php';

    if ($_SERVER['REQUEST_METHOD'] != 'POST' or !isset($_POST['username']) or !isset($_POST['password'])){
        header("Location: /error/bad_request.html", true, 303);
        exit();
    }

    $pdo = get_PDO();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticate($username, $password)) {
        $cookie = login($username);

        setcookie('sess_id', $cookie, time() + 60*60*24*14, '', '', true, true);
        header("Location: /", true, 301);
        exit();
    } else {
        header("Location: /sign-in.php", true, 303);
        exit();
    }
