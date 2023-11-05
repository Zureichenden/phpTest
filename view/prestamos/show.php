<?php
    $pageTitle = "Detalles de Préstamos"; 
    require_once("c://xampp/htdocs/phpTest/view/head/head.php");
    require_once("c://xampp/htdocs/phpTest/controller/prestamosController.php");
    $obj = new prestamosController();
    $prestamo = $obj->show($_GET['id']);
?>
<h2 class="text-center">Detalles del registro</h2>
<div class="pb-3">
    <a href="index.php" class="btn btn-primary">Regresar</a>
  
</div>

<table class="table container-fluid">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Cliente</th>
            <th scope="col">Monto del Préstamo</th>
            <th scope="col">Cantidad de Plazos</th>
            <th scope="col">Fecha de Inicio</th>
            <th scope="col">Interés</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th><?= $prestamo['id'] ?></th>
            <th><?= $prestamo['nombre_cliente'] ?></th>
            <th><?= '$' . number_format($prestamo['monto_prestamo'], 2) ?></th>
            <th><?= number_format($prestamo['cantidad_plazos']) ?></th>
            <th><?= $prestamo['fecha_inicio'] ?></th>
            <th><?= number_format($prestamo['interes'], 2) . '%' ?></th>
        </tr>
    </tbody>
</table>



<?php
    require_once("c://xampp/htdocs/phpTest/view/head/footer.php");
?>