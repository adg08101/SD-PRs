<?php
session_start();
if (!isset($_SESSION['session'])) {
    header('Location: index.php');
    die();
} else {
    $mysqli = new mysqli("localhost", "id16643740_root",
        "ContraTSK2021-*", "id16643740_tasks");
    if ($mysqli->connect_errno) {
        header('Location: logout.php');
        die();
    } else {
        $sql = "SELECT * FROM tareas WHERE mostrar = 1 ORDER BY estado ASC";
        $result = $mysqli->query($sql);
        $mysqli->close();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SD Task Management</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/main_styles.css" rel="stylesheet">
    <link href="css/vanillaSelectBox.css" rel="stylesheet">

    <script src="js/vanillaSelectBox.js"></script>

    <script src="js/app.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.js"></script>
</head>

<body>

<div class="container" id="app">
    <div class="row">
        <div class="col-2">
            <form method="get" action="logout.php">
                <input type="submit" value="Cerrar sesión" class="logout">
            </form>
            <form method="post" action="add.php">
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Responsable</label>
                    <select multiple class="form-control" id="responsable"
                            name="responsable[]" size="2" required>
                        <option>Ahmed</option>
                        <option>Pupo</option>
                        <option>Manu</option>
                        <option>Ovi</option>
                        <option>Rose</option>
                        <option>Yunior</option>
                        <option>Yasel</option>
                        <option>Fernando</option>
                        <option>Dayana</option>
                        <option>Angel</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tipo</label>
                    <select class="form-control" id="type" name="tipo">
                        <option>PR</option>
                        <option>Tarea</option>
                        <option>Reunión</option>
                        <option>Otro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tarea_id">Tarea ID</label>
                    <input class="form-control" id="tarea_id" name="prioridad">
                </div>
                <div class="form-group">
                    <label for="tarea_url">Tarea URL</label>
                    <textarea class="form-control" name="fecha"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">PRs</label>
                    <textarea class="form-control" id="task"
                              rows="3" name="tarea" required></textarea>
                </div>
                <input class="btn btn-primary" type="submit" value="Adicionar">
            </form>
        </div>
        <div class="col-10">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="col-sm-1" scope="col" style="display: none">Id</th>
                    <th class="col-sm-1" scope="col">Tipo</th>
                    <th class="col-sm-1" scope="col">Responsable</th>
                    <th class="col-sm-1" scope="col">ID</th>
                    <th class="col-sm-3" scope="col">Tarea URL</th>
                    <th class="col-sm-3" scope="col">PR(s)</th>
                    <th class="col-sm-1" scope="col">Estado</th>
                    <th class="col-sm-1" scope="col">Operaciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) { ?>
                        <tr class="<?= str_replace(" ", "_", $row['estado']); ?>">
                            <form action="update.php" method="post">
                            <th scope="row" style="display: none">
                                <input type="text" value="<?= $row['id']; ?>"
                                name="id" class="id">
                            </th>
                            <td>
                                <select id="type" name="tipo" class="input_size">
                                    <option><?= $row['tipo']; ?></option>
                                    <option>PR</option>
                                    <option>Tarea</option>
                                    <option>Reunión</option>
                                    <option>Otro</option>
                                </select>
                            </td>
                            <td>
                                <select multiple class="form-control"
                                        id="resp<?= $row['id']; ?>"
                                        name="responsable[]" size="2"
                                        type="<?= $row['responsable']; ?>"
                                        required>
                                    <option>Ahmed</option>
                                    <option>Pupo</option>
                                    <option>Manu</option>
                                    <option>Ovi</option>
                                    <option>Rose</option>
                                    <option>Yunior</option>
                                    <option>Yasel</option>
                                    <option>Fernando</option>
                                    <option>Dayana</option>
                                    <option>Angel</option>
                                </select>
                            </td>
                            <td>
                                <input class="input_size" id="priority" name="prioridad" value="<?= $row['prioridad']; ?>">
                            </td>
                            <td>
                                <textarea onclick="show_update(this.id)" id="url_<?= $row['prioridad']; ?>" class="full_width" name="fecha"><?= $row['fecha_hora']; ?></textarea>
                                <a href="<?= $row['fecha_hora']; ?>" target="_blank">Task <?= $row['prioridad']; ?></a>
                            <td>
                                   <textarea onclick="show_update(this.id)" id="pr_<?= $row['prioridad']; ?>" class="full_width" id="task"
                                             title="<?= $row['tarea']; ?>"
                                             rows="3" name="tarea" required><?= $row['tarea']; ?></textarea>
                            </td>
                            <td>
                                <select id="priority"
                                        name="estado">
                                    <option> <?= $row['estado']; ?></option>
                                    <option>Por hacer</option>
                                    <option>On hold</option>
                                    <option>Hecha</option>
                                </select>
                            </td>
                            <td>
                                <input type="submit" class="btn btn-primary
                                btn-sm" value="S" id="<?= $row['prioridad']; ?>_btn_save">
                                <input type="button" class="btn btn-secondary
                                btn-sm" value="D" onclick="delete_task
                                ('<?= $row['id']; ?>', '<?= $row['prioridad']; ?>')">
                            </td>
                            </form>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
            <?php
            $mysqli = new mysqli("localhost", "id16643740_root",
            "ContraTSK2021-*", "id16643740_tasks");
            if ($mysqli->connect_errno) {
            header('Location: logout.php');
            die();
            } else {
            $sql = "SELECT * FROM tareas WHERE mostrar = 1 AND estado = 'Por hacer'";
            $result = $mysqli->query($sql);
            $mysqli->close();
            }
            ?>
            <div class="hidden" id="edit_container">
                <textarea id="edit_area" class="output margin-top"></textarea>
                <input class="btn btn-primary" type="button" value="Save" onclick="save()">
                <input class="btn btn-secondary" type="button" value="Cancel" onclick="cancel()">
            </div>
            <div class="container output margin-top">
                <input class="btn btn-primary" type="button" value="Print" onclick="print()">
                <textarea id="output_format" class="output margin-top"><?php if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { ?><?= 'Task '.$row['prioridad']; ?> - <?= $row['fecha_hora']; ?><?= $row['tarea']; ?><?php } ?><?php } ?></textarea>
            </div>
        </div>
    </div>
</div>
</body>
</html>
