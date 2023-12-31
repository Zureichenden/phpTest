<?php
    $pageTitle = "Amortizaciones del cliente"; 
    require_once("c://xampp/htdocs/phpTest/view/head/head.php");
    require_once("c://xampp/htdocs/phpTest/controller/prestamosController.php");
    $obj = new prestamosController();
    $rows = $obj->mostrarTablaAmortizacionByPrestamo($_GET['id']);

?>

<div class="pb-3">
    <a href="index.php" class="btn btn-primary">Regresar</a>
  
</div>

<!-- Agrega el botón "Generar PDF" -->
<a href="generar_pdf.php?id=<?= $_GET['id'] ?>&rows=<?= urlencode(json_encode($rows)) ?>" class="btn btn-primary">Generar PDF</a>



<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">ID Préstamo</th>
            <th scope="col">ID Amortización</th>
            <th scope="col">NO. Pago</th>
            <th scope="col">Fecha</th>
            <th scope="col">Préstamo</th>
            <th scope="col">Interés</th>
            <th scope="col">Abono</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($rows) {
            $totalPrestamo = 0;
            $totalInteres = 0;
            $totalAbono = 0;

            foreach ($rows as $row) {
                $totalPrestamo += $row['monto_pago'];
                $totalInteres += $row['interes'];
                $totalAbono += $row['abono'];
                ?>
                <tr>
                    <th><?= $row['prestamo_id'] ?></th>
                    <th><?= $row['amortizacion_id'] ?></th>
                    <th><?= $row['NO_PAGO'] ?></th>
                    <th><?= date("d/m/Y", strtotime($row['fecha'])) ?></th>
                    <th><?= '$' . number_format($row['monto_pago'], 2) ?></th>
                    <th><?= '$' . number_format($row['interes'], 2) ?></th>
                    <th><?= '$' . number_format($row['abono'], 2) ?></th>
                </tr>
                <?php
            }
            ?>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Total Préstamo: $<?= number_format($totalPrestamo, 2) ?></th>
                <th>Total Interés: $<?= number_format($totalInteres, 2) ?></th>
                <th>Total Abono: $<?= number_format($totalAbono, 2) ?></th>
            </tr>
            <?php
        } else {
            ?>
            <tr>
                <td colspan="7" class="text-center">No hay registros que coincidan con la búsqueda.</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<?php
    require_once("c://xampp/htdocs/phpTest/view/head/footer.php");
?>