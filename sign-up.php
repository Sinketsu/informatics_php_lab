<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Sign-up</title>

    <link rel="icon" href="img/favicon.png">

    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/sign-up.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="row justify-content-center align-content-start">
                    <img src="img/logo.png"  width="400">
                </div>

                <div class="row">
                    <div class="col">
                        <br>
                        <h4>Welcome to the VoidCTF!</h4>
                        <p>Here on this battleground, we fight with machines. We've achieved much. We've confirmed that the network core have been destroyed. Humanity has chosen to seize this opportunity and launch an all-out attack against the machine forces.</p>
                        <p>We will never give up our struggle. We will take back our world from the scourge of the machines! </p>
                        <h5>Glory to CTFers!</h5>
                        <p class="mt-5 mb-3 text-muted ">&copy; sollos</p>
                    </div>
                </div>
            </div>
            <div class="col text-center vcenter">
                <form class="form-signup" action="sign-up-interact.php" method="post">
                    <h1 class="h3 mb-3 font-weight-normal">Do you want to join?</h1>
                    <a class="text-center" href="/sign-in.php">Already joined?</a>

                    <label for="inputNickname" class="sr-only">Nickname</label>
                    <input type="text" id="inputNickname" name="username" class="form-control"
                           placeholder="Nickname" required autofocus>

                    <label for="inputEmail" class="sr-only">Email</label>
                    <input type="email" id="inputEmail" name="email" class="form-control"
                           placeholder="Email" required autofocus>

                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" name="password" class="form-control"
                           placeholder="Password" aria-describedby="passwordHelp" autocomplete="off" required>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block form-control" type="submit">
                        Join!
                    </button>

                    <?php
                        include_once 'utils/csrf.php';

                        set_csrf_token();
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>