<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test index</title>
</head>
<body>
    Hello,
    <?php
        include_once 'utils/dbworker.php';

        if (isset($_COOKIE['sess_id'])) {
            $pdo = get_PDO();
            $stmt = $pdo->prepare("SELECT session_key,user_id,expiring_time FROM sessions WHERE
                                            session_key = :key");
            $stmt->execute(['key' => $_COOKIE['sess_id']]);
            $row = $stmt->fetch();
            if (!$row)
                print '%username%';

            $time = (int)$row['expiring_time'];
            if (time() > $time)
                print '%username%';

            $stmt = $pdo->prepare("SELECT username FROM users WHERE id = :id");
            $stmt->execute(['id' => $row['user_id']]);
            $row = $stmt->fetch();

            print $row['username'];
        } else
            print '%username%';
    ?>
    <p><a href="/sign-in.html">Sign in</a></p>
    <a href="/sign-up.html">Sign up</a>
</body>
</html>

