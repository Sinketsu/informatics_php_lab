<?php
    if ($_SERVER['REQUEST_METHOD'] != 'POST' or !isset($_POST['task']) or !isset($_POST['flag'])){
        header("Location: /error/bad_request.html", true, 303);
        exit();
    }

    include_once 'utils/dbworker.php';
    include_once 'utils/auth.php';

    $user = auth_get_user($_COOKIE);
    if (!$user) {
        header("Location: /error/bad_request.html", true, 303);
        exit();
    }

    $pdo = get_PDO();

    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $_POST['task']]);
    $task = $stmt->fetch();

    if (!$task) {
        header("Location: /error/bad_request.html", true, 303);
        exit();
    }

    if ($task['flag'] !== $_POST['flag']) {
        print 'incorrect flag';
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO solvings (task_id, username, solving_time) 
                                      VALUES (:task, :username, NOW())");
    $stmt->execute(['task' => $_POST['task'], 'username' => $user['username']]);

    header("Location: /task.php?id=" . $_POST['task'], true, 303);
    exit();













