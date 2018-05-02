<?php
    include_once 'dbworker.php';

    function authenticate($username, $password) {
        $pdo = get_PDO();

        $stmt = $pdo->prepare("SELECT username,password FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);

        $row = $stmt->fetch();
        $db_password = explode('$', $row['password']);
        $iterations = (int)$db_password[0];
        $salt = $db_password[1];
        $hash = $db_password[2];

        $hashed_password = hash_pbkdf2('sha384', $password, $salt, $iterations);

        return hash_equals($hash, $hashed_password);
    }

    function login($username) {
        $pdo = get_PDO();

        $fp = fopen('/dev/urandom', 'r');
        $randomBytes = fread($fp, 24);
        fclose($fp);
        $session_key = base64_encode($randomBytes);

        $stmt = $pdo->prepare("SELECT * FROM sessions WHERE session_key = :key");
        $stmt->execute(['key' => $session_key]);
        $row = $stmt->fetch();
        while ($row) {
            $fp = fopen('/dev/urandom', 'r');
            $randomBytes = fread($fp, 24);
            fclose($fp);
            $session_key = base64_encode($randomBytes);

            $stmt->execute(['key' => $session_key]);
            $row = $stmt->fetch();
        }

        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);

        $user_id = $stmt->fetch()['id'];

        $stmt = $pdo->prepare("INSERT INTO php_db.sessions (session_key, user_id, expiring_time) 
                                    VALUES (:session_key, :user_id, :time)");

        $expiring_time = time() + 60 * 60 * 24 * 14; // 14 days

        $stmt->execute([
            'session_key' => $session_key,
            'user_id' => $user_id,
            'time' => $expiring_time
        ]);

        return $session_key;
    }