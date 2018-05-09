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
        $user = null;
        $username = null;
        if (!is_null($user_id)) {
            $user = get_user_by_id($user_id);
            $username = $user['username'];

            print "<a class=\"p-2 text-dark\">$username</a> 
                        <a class=\"p-2 text-dark\" href=\"/logout.php?path=scoreboard.php\">Log out</a>";
        } else {
            print '<a class="btn btn-outline-primary mx-1" href="/sign-in.php">Sign in</a>
                        <a class="btn btn-outline-primary mx-1" href="/sign-up.php">Sign up</a>';
        }
        ?>
    </nav>
    <div class="container">
        <div class="row" style="height: 100px"></div>
        <div class="row justify-content-center">
            <h4 class="text-secondary ">SCOREBOARD</h4>
        </div>
        <div class="row" style="height: 20px"></div>
        <div class="row">
            <p class="font-weight-bold ml-3">
                <?php
                    print "Your score is: $user[points]";
                ?>
            </p>
        </div>
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
                include_once 'utils/array_helper.php';

                $pdo = get_PDO();

                $stmt = $pdo->prepare("SELECT
                                                  users.username,
                                                  users.points,
                                                  v_t.solv_time
                                                FROM users
                                                  LEFT JOIN (
                                                              SELECT
                                                                username,
                                                                MAX(solving_time) as solv_time
                                                              FROM
                                                                solvings
                                                              GROUP BY username
                                                            ) v_t
                                                  USING (username);");

                $stmt->execute();
                $arr = $stmt->fetchAll();
                $arr = array_sort($arr);

                $i = 1;
                foreach ($arr as $row) {
                    print "<tr" . ((!is_null($username) and $row['username'] === $username) ?
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
