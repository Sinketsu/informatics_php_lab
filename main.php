<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Tasks</title>

    <link rel="icon" href="img/favicon.png">

    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/main.css" type="text/css" rel="stylesheet">
</head>
<body>
<nav class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">VoidCTF</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="/main.php">Tasks</a>
        <a class="p-2 text-dark" href="#">Scoreboard</a>
        <a class="d-inline divider-vertical"></a>
    </nav>
    <?php
        include_once 'utils/auth.php';

        $user_id = auth_get_user($_COOKIE);
        if (!is_null($user_id)) {
            print '<a class=\"p-2 text-dark\" href=\"#\">Profile</a> 
                    <a class=\"p-2 text-dark\" href=\"#\">Log out</a>';
        } else {
            print '<a class="btn btn-outline-primary mx-1" href="/sign-in.html">Sign in</a>
                    <a class="btn btn-outline-primary mx-1" href="/sign-up.html">Sign up</a>';
        }
    ?>
</nav>
</body>
</html>