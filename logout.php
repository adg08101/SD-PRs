<?php
session_start();
unset($_SESSION['session']);
session_destroy();
header('Location: index.php');
die();
