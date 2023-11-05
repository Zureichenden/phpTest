<?php
    $pageTitle = "Editar Plazos y Montos"; 
    require_once("c://xampp/htdocs/phpTest/view/head/head.php");
    require_once("c://xampp/htdocs/phpTest/controller/catalogoMontosController.php");
    $obj = new catalogoMontosController();
    $catalogoMonto = $obj->show($_GET['id']);
?>
  <form action="update.php" method="post" autocomplete="off">
    <h2>Modificando Registro</h2>
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Id</label>
        <div class="col-sm-10">
        <input type="text" name="id" readonly class="form-control-plaintext" id="staticEmail" value="<?= $catalogoMonto[0]?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputMonto" class="col-sm-2 col-form-label">Nuevo Monto</label>
        <div class="col-sm-10">
            <input type="number" name="monto" class="form-control" id="inputMonto" value="<?= $catalogoMonto[1]?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputCantidadPlazos" class="col-sm-2 col-form-label">Nuevo Plazo en Quincenas</label>
        <div class="col-sm-10">
            <input type="number" name="cantidad_plazos" class="form-control" id="inputCantidadPlazos" value="<?= $catalogoMonto[2]?>">
        </div>
    </div>
    <div>
        <input type="submit" class="btn btn-success" value="Actualizar">
        <a class="btn btn-danger" href="show.php?id=<?= $catalogoMonto[0]?>">Cancelar</a>
    </div>
  </form>
<?php
    require_once("c://xampp/htdocs/phpTest/view/head/footer.php");
?>