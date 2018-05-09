<?php
    function generate_token() {
        $fp = fopen('/dev/urandom', 'r');
        $randomBytes = fread($fp, 24);
        fclose($fp);
        $csrf_token = base64_encode($randomBytes);

        return $csrf_token;
    }

    function check_csrf() {
        if (!isset($_COOKIE['X-CSRF-Token']) or !isset($_POST['CSRF-token'])) {
            header("Location: /error/csrf.html", true, 303);
            exit();
        }

        if ($_COOKIE['X-CSRF-Token'] != $_POST['CSRF-token']) {
            header("Location: /error/csrf.html", true, 303);
            exit();
        }
    }

    function set_csrf_token() {
        $token = generate_token();

        setcookie('X-CSRF-Token', $token, time() + 60*60*5, '', '', true, true);
        print "<input name=\"CSRF-token\" value=\"$token\" hidden>\n";
    }