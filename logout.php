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

    header("Location: /task.php?id=$_GET[path]", true, 303);
    exit();
