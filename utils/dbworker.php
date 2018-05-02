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