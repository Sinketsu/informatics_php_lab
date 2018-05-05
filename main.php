<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Tasks</title>

    <link rel="icon" href="img/favicon.png">

    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/main.css" type="text/css" rel="stylesheet">
    <link href="css/colors.css" type="text/css" rel="stylesheet">
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
    <div class="row" style="height: 100px"></div>
    <div class="row justify-content-center">
        <h4 class="text-secondary">Here are tasks for you. Please, help us...</h4>
    </div>
    <div class="row" style="height: 20px"></div>
</div>
<div class="container">
    <div class="row">
        <?php
            include_once 'utils/dbworker.php';
            include_once 'utils/array_helper.php';

            $pdo = get_PDO();

            $tasks = null;
            if (!is_null($username)) {
                $stmt = $pdo->prepare("SELECT
                                                  tasks.*,
                                                  ISNULL(v_t.task_id) as solved
                                                FROM
                                                  tasks
                                                  LEFT JOIN (
                                                              SELECT task_id
                                                              FROM
                                                                solvings
                                                              WHERE
                                                                username = :username
                                                            ) v_t
                                                    ON v_t.task_id = tasks.id;");
                $stmt->execute(['username' => $username]);

                $tasks = $stmt->fetchAll();
            } else {
                $stmt = $pdo->prepare("SELECT *
                                                FROM tasks;");
                $stmt->execute();

                $tasks = $stmt->fetchAll();
            }

            foreach ($tasks as $task) {
                print $colors[$task['category']];
                print "<a class=\"card text-white card-link " . $colors[$task['category']] . " rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2\" href=\"task.php?id=$task[id]\">\n";
                print "\t<div class=\"card-body\">\n";
                print "\t\t<h5 class=\"card-title \">$task[category]</h5>\n";
                print "\t\t<h1 class=\"card-title text-center\">$task[cost]</h1>\n";
                print "\t\t<p class=\"card-text\">$task[name]</p>\n";
                print "\t</div>\n";

                if (isset($task['solved']) and $task['solved'] == 0) {
                    print "<div class=\"overlay align-items-center\">\n";
                    print "\t<h1 class=\"col\">SOLVED</h1>\n";
                    print "</div>\n";
                }

                print "</a>\n";
            }

        ?>
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
        <a class="card text-white card-link bg-warning rounded-0  col-6 m-0 col-sm-4 col-lg-3 col-xl-2" href="#">
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
        <a class="card text-white card-link bg-danger rounded-0 col-6 m-0 col-sm-4 col-lg-3 col-xl-2" href="#">
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
