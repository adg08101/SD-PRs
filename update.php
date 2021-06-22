<?php
session_start();
if (!isset($_SESSION['session'])) {
    header('Location: index.php');
    die();
} elseif (isset($_GET['option'], $_GET['id'])) {
    if ($_GET['option'] == 'hide') {
        $mysqli = new mysqli("localhost", "id16643740_root", "ContraTSK2021-*", "id16643740_tasks");

        $id = $_GET['id'];
        $sql = "UPDATE `tareas` SET `mostrar`=0 WHERE `id` = $id";

        if (mysqli_query($mysqli, $sql)) {
            header('Location: main.php');
            die();
        } else {
            header('Location: logout.php');
            die();
        }
    } else {
        header('Location: main.php');
        die();
    }
} elseif (!isset($_POST['id'])) {
    header('Location: main.php');
    die();
} else {
    $mysqli = new mysqli("localhost", "id16643740_root", "ContraTSK2021-*", "id16643740_tasks");
    if ($mysqli->connect_errno) {
        header('Location: logout.php');
        die();
    } else {
        $id = $_POST['id'];
        $prioridad = $_POST['prioridad'];
        $fecha = $_POST['fecha'];
        $responsable = isset($_POST['responsable']);
        $tarea = $_POST['tarea'];
        $tipo = $_POST['tipo'];
        $estado = $_POST['estado'];

        $error_value = null;
        $error = false;

        if (!$responsable) {
            $error = true;
            $error_value .= 'resp;';
        } else {
            $responsable = $_POST['responsable'];
        }

        if (empty($tarea) or ctype_space($tarea)) {
            $error = true;
            $error_value .= 'task;';
        }

        if ($error) {
            header('Location: main.php?error='.$error_value);
            die();
        }

        if (count($responsable) == 1)
            $responsable = $responsable[0];
        else
            $responsable = implode(", ", $responsable);

        $sql = "UPDATE `tareas` SET `responsable`='$responsable',
            `tipo`='$tipo',`prioridad`='$prioridad',`fecha_hora`='$fecha',
            `tarea`='$tarea',`estado`='$estado' WHERE `id` = $id";

        if (mysqli_query($mysqli, $sql)) {
            header('Location: main.php');
            die();
        } else {
            header('Location: logout.php');
            die();
        }
        mysqli_close($mysqli);
    }
}