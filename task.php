<?php
    include_once 'utils/dbworker.php';

    if ($_SERVER['REQUEST_METHOD'] != 'GET' or !isset($_GET['id'])) {
        header("Location: /error/bad_request.html", true, 303);
        exit();
    }

    $task = get_task($_GET['id']);
    if (!$task) {
        header("Location: /error/bad_request.html", true, 303);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <?php
        print "<title>$task[name]</title>";
    ?>

    <link rel="icon" href="img/favicon.png">

    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/task.css" type="text/css" rel="stylesheet">
</head>
<body>
    <nav class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal">VoidCTF</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="/main.php">Tasks</a>
            <a class="p-2 text-dark" href="/scoreboard.php">Scoreboard</a>
            <a class="d-inline divider-vertical"></a>
        </nav>
        <?php
        include_once 'utils/auth.php';

        $user_id = auth_get_user($_COOKIE);
        $username = null;
        if (!is_null($user_id)) {
            $username = get_user_by_id($user_id)['username'];

            print "<a class=\"p-2 text-dark\" href=\"#\">$username</a> 
                            <a class=\"p-2 text-dark\" href=\"#\">Log out</a>";
        } else {
            print '<a class="btn btn-outline-primary mx-1" href="/sign-in.html">Sign in</a>
                            <a class="btn btn-outline-primary mx-1" href="/sign-up.html">Sign up</a>';
        }
        ?>
    </nav>

    <div class="container">
        <div class="row" style="height: 50px"></div>
        <a href="/main.php">
            <button type="button" class="btn btn-lg btn-outline-dark offset-2 my-3"><< Tasks</button>
        </a>

        <?php
            include_once "utils/array_helper.php";

            $task_author_line = ($task['author'] === "") ?
                "<p class=\"row text-white justify-content-center\"></p>" :
                "<p class=\"row text-white justify-content-center\">Author: $task[author]</p>";

            print <<<TASK_BODY
        <div class="col-8 offset-2 {$colors[$task['category']]}">
            <div class="row">
                <div class="col-4">
                    <h5 class="text-white row m-2" style="padding-top: 10px;">$task[category]</h5>
                    <h1 class="text-white row m-2">$task[cost]</h1>
                </div>
                <div class="col align-self-center m-3">
                    <h3 class="row text-white justify-content-center">$task[name]</h3>
                    $task_author_line
                </div>
            </div>
            <div class="row">
                <div class="col m-1">
                    $task[text]
                </div>
            </div>
            <div class="row" style="height: 50px"></div>
            <form class="row justify-content-center align-items-center" action="/solve.php" method="post">
                <input name="task" value="$task[id]" hidden>
                <div class="col-2">
                    <p class="text-white font-weight-bold lead text-">Flag:</p>
                </div>
                <div class="col-5">
                    <input type="text" name="flag" class="input-group form-control mb-3 rounded-0" style="height: 30px;">
                </div>
                <button type="submit" class="btn btn-outline-light mb-3 font-weight-bold" >Check >></button>
            </form>
TASK_BODY;
            if (isset($_GET['msg'])) {
                print "<div class=\"row justify-content-center\">
                                <h5 class=\"text-white font-weight-bold\">$_GET[msg]</h5>
                           </div>";
            }

            print "</div>\n";
        ?>
    </div>
</body>
</html>
