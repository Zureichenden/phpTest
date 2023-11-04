<?php
    require_once("c://xampp/htdocs/phpTest/view/head/head.php");
    require_once("c://xampp/htdocs/phpTest/controller/prestamosController.php");
    $obj = new prestamosController();
    $rows = $obj->index();
?>
<div class="mb-3">
    <a href="/phpTest/view/prestamos/create.php" class="btn btn-primary">Agregar nuevo Préstamo</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Cliente</th>
            <th scope="col">Monto del Prestamo</th>
            <th scope="col">Cantidad de Plazos</th>
            <th scope="col">Fecha de Inicio</th>
            <th scope="col">Interés</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if($rows): ?>
            <?php foreach($rows as $row): ?>
                <tr>
                    <th><?= $row['prestamo_id'] ?></th>
                    <th><?= $row['nombre_cliente'] ?></th>
                    <th><?= '$' . number_format($row['monto_prestamo'], 2) ?></th>
                    <th><?= number_format($row['cantidad_plazos']) ?></th>
                    <th><?= $row['fecha_inicio'] ?></th>
                    <th><?= number_format($row['interes'], 2) . '%' ?></th>

                    <th>
                        <a href="show.php?id=<?= $row[0]?>" class="btn btn-primary">Ver</a>
               
                    </th>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center">No hay registros actualmente</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php
    require_once("c://xampp/htdocs/phpTest/view/head/footer.php");
?>