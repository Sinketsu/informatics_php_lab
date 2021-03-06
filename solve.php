<?php

    include_once 'utils/csrf.php';

    check_csrf();

    if ($_SERVER['REQUEST_METHOD'] != 'POST' or !isset($_POST['task']) or !isset($_POST['flag'])){
        header("Location: /error/bad_request.html", true, 303);
        exit();
    }

    $task_id = filter_var($_POST['task'], FILTER_SANITIZE_NUMBER_INT);

    include_once 'utils/dbworker.php';
    include_once 'utils/auth.php';

    $user = auth_get_user($_COOKIE);
    if (!$user) {
        header("Location: /sign-in.php", true, 303);
        exit();
    }
    $user = get_user_by_id($user);

    $pdo = get_PDO();

    $stmt = $pdo->prepare("SELECT *
                                    FROM tasks
                                    WHERE id = :id");
    $stmt->execute(['id' => $task_id]);
    $task = $stmt->fetch();

    if (!$task) {
        header("Location: /error/bad_request.html", true, 303);
        exit();
    }

    if (! hash_equals($task['flag'], hash("sha384", $_POST['flag']))) {
        header("Location: /task.php?id=$task_id&msg=Incorrect%20flag%20%3A%28", true, 303);
        exit();
    }

    $stmt = $pdo->prepare("SELECT *
                                    FROM solvings
                                    WHERE task_id = :task AND username = :username");
    $stmt->execute(['task' => $task['id'], 'username' => $user['username']]);
    $row = $stmt->fetch();
    if ($row) {
        header("Location: /task.php?id=$task_id&msg=Flag%20is%20correct%2C%20but%20you%27ve%20already%20passed%20it", true, 303);
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO solvings (task_id, username, solving_time) 
                                    VALUES (:task, :username, NOW())");
    $stmt->execute(['task' => $task_id,
                    'username' => $user['username']]);

    $stmt = $pdo->prepare("SELECT cost
                                    FROM tasks
                                    WHERE id = :id");
    $stmt->execute(['id' => $task_id]);
    $cost = $stmt->fetch()['cost'];

    $stmt = $pdo->prepare("UPDATE users
                                    SET points = :points
                                    WHERE username = :username;");
    $stmt->execute(['points' => $user['points'] + $cost,
                    'username' => $user['username']]);

    header("Location: /task.php?id=$task_id&msg=Flag%20accepted%21", true, 303);
    exit();













