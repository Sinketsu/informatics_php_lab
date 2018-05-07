<?php
    if ($_SERVER['REQUEST_METHOD'] != 'GET' or !isset($_COOKIE['sess_id'])){
        header("Location: /error/bad_request.html", true, 303);
        exit();
    }

    include_once 'utils/dbworker.php';

    $pdo = get_PDO();

    $stmt = $pdo->prepare("DELETE FROM sessions
                                    WHERE session_key = :sess_id");
    $stmt->execute(['sess_id' => $_COOKIE['sess_id']]);

    $path = isset($_GET['path']) ? filter_var($_GET['path'], FILTER_SANITIZE_URL) : '/';
    $url = parse_url($path);
    if (isset($url['host'])) {
        header("Location: /error/bad_request.html", true, 303);
        exit();
    }
    $urls = ['/main.php', '/task.php', '/scoreboard.php'];
    if (!in_array($url['path'], $urls)) {
        header("Location: /error/bad_request.html", true, 303);
        exit();
    }

    header("Location: $path", true, 303);
    exit();
