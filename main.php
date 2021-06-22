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
        $sql = "SELECT * FROM tareas WHERE mostrar = 1";
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
                        <option>Fernando</option>
                        <option>Dayana</option>
                        <option>Angel</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tipo</label>
                    <select class="form-control" id="type" name="tipo">
                        <option>Tarea</option>
                        <option>Reunión</option>
                        <option>Otro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Prioridad</label>
                    <select class="form-control" id="priority" name="prioridad">
                        <option>Baja</option>
                        <option>Media</option>
                        <option>Alta</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Fecha</label>
                    <input class="form-control" type="datetime-local" name="fecha">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Tarea</label>
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
                    <th scope="col" style="display: none">Id</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Responsable</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Tarea</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Operaciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) { ?>
                        <tr class="<?= $row['prioridad']; ?>">
                            <form action="update.php" method="post">
                            <th scope="row" style="display: none">
                                <input type="text" value="<?= $row['id']; ?>"
                                name="id" class="id">
                            </th>
                            <td>
                                <select id="type" name="tipo">
                                    <option><?= $row['tipo']; ?></option>
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
                                    <option>Fernando</option>
                                    <option>Dayana</option>
                                    <option>Angel</option>
                                </select>
                            </td>
                            <td>
                                <select id="priority" name="prioridad">
                                    <option><?= $row['prioridad']; ?></option>
                                    <option>Baja</option>
                                    <option>Media</option>
                                    <option>Alta</option>
                                </select>
                            </td>
                            <td>
                                <input type="datetime-local"
                                       name="fecha" value="<?= $row['fecha_hora']; ?>">
                                </td>
                            <td>
                                   <textarea id="task"
                                             title="<?= trim($row['tarea']); ?>"
                                             rows="3" name="tarea" required><?= trim($row['tarea']); ?></textarea>
                            </td>
                            <td>
                                <select id="priority"
                                        name="estado">
                                    <option> <?= $row['estado']; ?></option>
                                    <option>Por hacer</option>
                                    <option>En progreso</option>
                                    <option>Hecha</option>
                                </select>
                            </td>
                            <td>
                                <input type="submit" class="btn btn-primary
                                btn-sm" value="Guardar">
                                <input type="button" class="btn btn-secondary
                                btn-sm" value="Eliminar" onclick="delete_task
                                (<?= $row['id']; ?>)">
                            </td>
                            </form>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
