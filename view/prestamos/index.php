<?php
require_once("c://xampp/htdocs/phpTest/view/head/head.php");
require_once("c://xampp/htdocs/phpTest/controller/prestamosController.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Préstamos</title>
    <link rel="stylesheet" href="/phpTest/view/prestamos/css/index.css">
</head>
<body>
<?php
$obj = new prestamosController();

$searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
$rows = [];

if ($searchTerm) {
    $rows = $obj->search($searchTerm);
} else {
    $rows = $obj->index();
}
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-6">
            <form action="index.php" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar Cliente" value="<?php echo $searchTerm; ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="/phpTest/view/prestamos/create.php" class="btn btn-primary">Agregar nuevo Préstamo</a>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nombre del Cliente</th>
                        <th>Monto del Préstamo</th>
                        <th>Cantidad de Plazos</th>
                        <th>Fecha de Inicio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($rows): ?>
                        <?php foreach ($rows as $row): ?>
                            <tr>
                                <td><?= $row['nombre_cliente'] ?></td>
                                <td><?= '$' . number_format($row['monto_prestamo'], 2) ?></td>
                                <td><?= number_format($row['cantidad_plazos']) ?></td>
                                <td><?= date("d/m/Y", strtotime($row['fecha_inicio'])) ?></td>
                                <td>
                                    <a href="show.php?id=<?= $row['prestamo_id'] ?>" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> Ver Registro
                                    </a>
                                    <a href="edit.php?id=<?= $row['prestamo_id'] ?>" class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil"></i> Editar
                                    </a>
                                    <a href="delete.php?id=<?= $row['prestamo_id'] ?>" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </a>
                                    <a href="amortizacion.php?id=<?= $row['prestamo_id'] ?>" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> Ver Amortización
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="no-records">No hay registros que coincidan con la búsqueda.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once("c://xampp/htdocs/phpTest/view/head/footer.php");
?>
</body>
</html>
