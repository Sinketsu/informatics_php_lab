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

                $pdo = get_PDO();
                $stmt = $pdo->prepare("SELECT username, points FROM users ORDER BY points DESC ");
                $stmt->execute();

                $i = 1;
                while($row = $stmt->fetch()) {
                    print "<tr>
                            <th scope=\"row\" >$i</th>
                            <td >$row\['username'\]</td>
                            <td class=\"font-weight-bold\">$row\['points'\]</td>
                            </tr>";
                }


            ?>
            <tr class="table-warning">
                <th scope="row" >4</th>
                <td >Yola</td>
                <td class="font-weight-bold">120</td>
            </tr>

            </tbody>
        </table>
    </div>
</body>
</html>
