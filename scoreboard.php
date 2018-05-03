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
                include_once 'utils/auth.php';

                $pdo = get_PDO();

                $user_id = auth_get_user($_COOKIE);
                $current_username = null;
                if (!is_null($user_id)) {
                    $stmt = $pdo->prepare("SELECT username FROM users WHERE id = :id");
                    $stmt->execute($user_id);
                    $row = $stmt->fetch();

                    $current_username = $row['username'];
                }

                $stmt = $pdo->prepare("SELECT username, points FROM users ORDER BY points DESC ");
                $stmt->execute();

                $i = 1;
                while($row = $stmt->fetch()) {
                    print "<tr" . ((!is_null($current_username) and $row['username'] == $current_username) ?
                            " class=\"table-warning\"" : "") . ">
                            <th scope=\"row\" >$i</th>
                            <td >$row[username]</td>
                            <td class=\"font-weight-bold\">$row[points]</td>
                            </tr>";
                    $i++;
                }


            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
