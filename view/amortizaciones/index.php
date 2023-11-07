<?php
$pageTitle = "Listado de Préstamos"; 
require_once("c://xampp/htdocs/phpTest/view/head/head.php");
require_once("c://xampp/htdocs/phpTest/controller/amortizacionController.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpTest/view/prestamos/css/index.css">
</head>
<body>
<?php
$obj = new amortizacionController();

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
    
    </div>
    
    <div class="row mt-4">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col">ID Préstamo</th>
                    <th scope="col">ID Amortización</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">NO. Pago</th>
                    <th scope="col">Fecha </th>
                    <th scope="col">Préstamo</th>
                    <th scope="col">Interés</th>
                    <th scope="col">Abono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($rows): ?>
                        <?php foreach ($rows as $row): ?>
                            <tr>

                            <th><?= $row['prestamo_id'] ?></th>
                    <th><?= $row['id'] ?></th>
                    <th><?= $row['nombre_cliente'] ?></th>

                    <th><?= $row['quincena'] ?></th>
                    <th><?= date("d/m/Y", strtotime($row['fecha_pago'])) ?></th>
                    <th><?= '$' . number_format($row['monto_pago'], 2) ?></th>
                    <th><?= '$' . number_format($row['interes'], 2) ?></th>
                    <th><?= '$' . number_format($row['abono'], 2) ?></th>
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
