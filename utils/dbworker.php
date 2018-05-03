<?php
    function get_PDO() {
        $user = "root";
        $pass = "swordart1337";
        $dsn = "mysql:host=localhost;dbname=php_db";
        $opt = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $pdo = new PDO($dsn, $user, $pass, $opt);

        return $pdo;
    }

    function get_user_by_id($user_id) {
        $pdo = get_PDO();

        $stmt = $pdo->prepare("SELECT username, points FROM users WHERE id = :id");
        $stmt->execute(['id' => $user_id]);

        $row = $stmt->fetch();

        return $row;
    }