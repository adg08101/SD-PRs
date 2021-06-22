<?php
    if (isset($_POST['user'], $_POST['pass']))
        if ($_POST['user'] == 'SmartDrops' && $_POST['pass'] == 'SD123') {
            session_start();
            $_SESSION['session'] = 'SmartDrops';
            header('Location: main.php');
        }
        else {
            header('Location: index.php');
            die();
        }
    else
        header('Location: index.php');
        die();
