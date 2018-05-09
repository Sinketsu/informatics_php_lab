<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        <title>Sign in</title>

        <link rel="icon" href="img/favicon.png">

        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="css/sign-in.css" type="text/css" rel="stylesheet">
    </head>
    <body class="text-center">
        <form class="form-signin" action="sign-in-interact.php" method="post">
            <img src="img/logo.png" id="img" alt="" width="225" height="150">

            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

            <label for="inputNickname" class="sr-only">Nickname</label>
            <input type="text" id="inputNickname" class="form-control" placeholder="Nickname"
                   name="username" required autofocus>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password"
                   name="password" autocomplete="off" required>

            <button class="btn btn-lg btn-primary btn-block my-2" type="submit">Sign in</button>

            <?php
                include_once 'utils/csrf.php';

                set_csrf_token();
            ?>

            <a href="/sign-up.php">Register?</a>
            <p class="mt-5 mb-3 text-muted">&copy; sollos</p>
        </form>
    </body>
</html>