<?php
    require_once("c://xampp/htdocs/phpTest/view/head/head.php");
?>

<form action="save.php" method="POST" autocomplete="off">
    <div class="mb-3">
        <label for="labelMonto" class="form-label">Monto</label>
        <input type="number" name="monto" required class="form-control" id="inputMonto">
    </div>

    <div class="mb-3">
        <label for="labelPlazos" class="form-label">Plazos en Quincenas</label>
        <input type="number" name="cantidad_plazos" required class="form-control" id="inputPlazos">
    </div>
    

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-danger" href="index.php">Cancelar</a>
</form>

<?php
    require_once("c://xampp/htdocs/phpTest/view/head/footer.php");
?>