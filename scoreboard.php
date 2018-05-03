<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Scoreboard</title>

    <link rel="icon" href="img/favicon.png">

    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/scoreboard.css" type="text/css" rel="stylesheet">
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
            <h4 class="text-secondary ">SCOREBOARD</h4>
        </div>
        <div class="row" style="height: 20px"></div>
    </div>
    <div class="container">
        <table class="table table-striped table-hover table-light">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nickname</th>
                <th scope="col">Score</th>
            </tr>
            </thead>
            <tbody>
            <?php
                include_once 'utils/dbworker.php';

                $pdo = get_PDO();

                $user_id = auth_get_user($_COOKIE);
                $current_username = (!is_null($user_id)) ? get_user_by_id($user_id)['username'] : null;

                $stmt = $pdo->prepare("SELECT username, points FROM users ORDER BY points DESC ");
                $stmt->execute();

                $i = 1;
                while($row = $stmt->fetch()) {
                    print "<tr" . ((!is_null($current_username) and $row['username'] === $current_username) ?
                            " class=\"table-warning\"" : "") . ">
                            <th scope=\"row\" >$i</th>
                            <td >$row[username]</td>
                            <td class=\"font-weight-bold\">$row[points]</td>
                            </tr>" . "\n";
                    $i++;
                }


            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
