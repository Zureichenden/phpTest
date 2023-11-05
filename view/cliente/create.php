<?php
    $pageTitle = "Añadir Cliente"; 
    require_once("c://xampp/htdocs/phpTest/view/head/head.php");
?>

<form action="save.php" method="POST" autocomplete="off">
    <div class="mb-3">
        <label for="labelNombre" class="form-label">Nombre del cliente</label>
        <input type="text" name="nombre" required class="form-control" id="inputNombre">
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-danger" href="index.php">Cancelar</a>
</form>

<?php
    require_once("c://xampp/htdocs/phpTest/view/head/footer.php");
?>