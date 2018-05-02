<?php
    include_once 'dbworker.php';

    function authenticate($username, $password) {
        // TODO check passwd
    }

    function login($username) {
        $pdo = get_PDO();

        $fp = fopen('/dev/urandom', 'r');
        $randomBytes = fread($fp, 24);
        fclose($fp);
        $session_key = base64_encode($randomBytes);

        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user_id = $stmt[0]['id'];

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