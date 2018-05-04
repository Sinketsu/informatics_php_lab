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
        <a class="p-2 text-dark" href="/scoreboard.php">Scoreboard</a>
        <a class="d-inline divider-vertical"></a>
    </nav>
    <?php
        include_once 'utils/auth.php';

        $user_id = auth_get_user($_COOKIE);
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
    <div class="row" style="height: 100px"></div>
    <div class="row justify-content-center">
        <h4 class="text-secondary">Here are tasks for you. Please, help us...</h4>
    </div>
    <div class="row" style="height: 20px"></div>
</div>
<div class="container">
    <div class="row">
        <a class="card text-white card-link bg-success rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2" href="#">
            <div class="card-body">
                <h5 class="card-title ">FORENSICS</h5>
                <h1 class="card-title text-center">105</h1>
                <p class="card-text">Password manager</p>
            </div>
        </a>
        <a class="card text-white card-link bg-danger rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2" href="#">
            <div class="card-body">
                <h5 class="card-title ">REVERSE</h5>
                <h1 class="card-title text-center">105</h1>
                <p class="card-text">Password manager</p>
            </div>
        </a>
        <a class="card text-white card-link bg-dark rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2" href="#">
            <div class="card-body">
                <h5 class="card-title ">CRYPTO</h5>
                <h1 class="card-title text-center">105</h1>
                <p class="card-text">Pizzaburger</p>
                <p class="card-text text-white-50">@Sinketsu</p>
            </div>
        </a>
        <a class="card text-white card-link bg-info rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2" href="#">
            <div class="card-body">
                <h5 class="card-title ">WEB</h5>
                <h1 class="card-title text-center">105</h1>
                <p class="card-text">Password manager</p>
            </div>
        </a>
        <a class="card text-white card-link bg-primary rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2" href="#">
            <div class="card-body">
                <h5 class="card-title ">PPC</h5>
                <h1 class="card-title text-center">105</h1>
                <p class="card-text">Password manager</p>
            </div>
        </a>
        <a class="card text-white card-link bg-secondary rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2" href="#">
            <div class="card-body">
                <h5 class="card-title ">MISC</h5>
                <h1 class="card-title text-center">105</h1>
                <p class="card-text">Password manager</p>
            </div>
        </a>
        <a class="card text-white card-link bg-warning rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2" href="#">
            <div class="card-body">
                <h5 class="card-title ">RECON</h5>
                <h1 class="card-title text-center">105</h1>
                <p class="card-text">Password manager</p>
            </div>
        </a>
        <a class="card text-white card-link bg-pink rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2" href="#">
            <div class="card-body">
                <h5 class="card-title ">PWN</h5>
                <h1 class="card-title text-center">105</h1>
                <p class="card-text">Password manager</p>
            </div>
        </a>
        <a class="card text-white card-link bg-warning rounded-0  col-6 m-0 col-sm-4 col-lg-3 col-xl-2 solved" href="#">
            <div class="card-body">
                <h5 class="card-title ">FORENSICS</h5>
                <h1 class="card-title text-center">105</h1>
                <p class="card-text">Pizzaburger</p>
                <p class="card-text text-white-50">@Sinketsu</p>
            </div>
            <div class="overlay align-items-center">
                <h1 class="col">SOLVED</h1>
            </div>
        </a>
        <a class="card text-white card-link bg-danger rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2 solved" href="#">
            <div class="card-body">
                <h5 class="card-title ">FORENSICS</h5>
                <h1 class="card-title text-center">105</h1>
                <p class="card-text">Password manager</p>
            </div>
            <div class="overlay align-items-center">
                <h1 class="col">SOLVED</h1>
            </div>
        </a>
        <a class="card text-white card-link bg-purple rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2" href="#">
            <div class="card-body">
                <h5 class="card-title ">JOY</h5>
                <h1 class="card-title text-center">105</h1>
                <p class="card-text">Password manager</p>
            </div>
        </a>
        <a class="card text-white card-link bg-teal rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2" href="#">
            <div class="card-body">
                <h5 class="card-title ">STEGO</h5>
                <h1 class="card-title text-center">105</h1>
                <p class="card-text">Password manager</p>
            </div>
        </a>
    </div>




</div>

</body>
</html>
