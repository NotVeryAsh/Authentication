<?php

include('session.php');

require_once("Authentication.php");

$auth = new Authentication();
?>

<html lang="en">
<head>
    <title>Basic Cookie Auth</title>
</head>
    <body>
        <div>
            Hey,
            <?php
                echo $auth->user()['name'];
            ?>
        </div>
    </body>
</html>