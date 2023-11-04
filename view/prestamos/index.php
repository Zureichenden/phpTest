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
                        <a href="edit.php?id=<?= $row[0]?>" class="btn btn-success">Modificar</a>
                        <!-- Button trigger modal -->
                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#id<?=$row[0]?>">Eliminar</a>

                        <!-- Modal -->
                        <div class="modal fade" id="id<?=$row[0]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar el registro?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Una vez eliminado no se podra recuperar el registro
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                                    <a href="delete.php?id=<?= $row[0]?>" class="btn btn-danger">Eliminar</a>
                                    <!-- <button type="button" >Eliminar</button> -->
                                </div>
                                </div>
                            </div>
                        </div>
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