<?php
$pageTitle = "Nuevo Préstamo";
require_once("c://xampp/htdocs/phpTest/view/head/head.php");
require_once("c://xampp/htdocs/phpTest/controller/clienteController.php");
require_once("c://xampp/htdocs/phpTest/controller/catalogoMontosController.php");

$objClientes = new clienteController();
$clientes = $objClientes->getClientes();

$objCatalogoMontos = new catalogoMontosController();
$montos = $objCatalogoMontos->getMontosPlazos();
?>

<form action="save.php" method="POST" autocomplete="off">
<div class="mb-3">
    <label for="cliente_id" class="form-label">Selecciona un cliente</label>
    <select name="cliente_id" required class="form-select" id="cliente_id">
        <option value="" disabled selected>Selecciona un cliente</option>
        <?php
        foreach ($clientes as $cliente) {
            echo "<option value='" . $cliente['id'] . "'>" . $cliente['nombre'] . "</option>";
        }
        ?>
    </select>
</div>

<div class="mb-3">
    <label for="monto_id" class="form-label">Selecciona un monto de préstamo</label>
    <select name="monto_id" required class="form-select" id="monto_id">
        <option value="" disabled selected>Selecciona un monto de préstamo</option>
        <?php
        foreach ($montos as $monto) {
            echo "<option value='" . $monto['id'] . "'>" . $monto['id'] . ' - ' . $monto['monto'] . "</option>";
        }
        ?>
    </select>
</div>



    <div class="mb-3">
        <label for="cliente_id" class="form-label">ID del Cliente seleccionado:</label>
        <span id="cliente_id_text">N/A</span>
    </div>

    <div class="mb-3">
        <label for="monto_id" class="form-label">ID del Monto-Plazo seleccionado:</label>
        <span id="monto_id_text">N/A</span>
    </div>

    <div class="mb-3">
        <label for="monto" class="form-label">Monto de Préstamo</label>
        <input type="text" name="monto" required class="form-control" id="monto" disabled>
    </div>

    <div class="mb-3">
        <label for="plazo" class="form-label">Cantidad de Plazos</label>
        <input type="text" name="plazo" required class="form-control" id="plazo" disabled>
    </div>

    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
        <input type="date" name="fecha_inicio" required class="form-control" id="fecha_inicio">
    </div>

    <div class="mb-3">
        <label for="interes" class="form-label">Tasa de Interés</label>
        <input type="number" name="interes" step="0.01" required class="form-control" id="interes">
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-danger" href="index.php">Cancelar</a>
</form>

<script>
    var montos = <?php echo json_encode($montos); ?>;
    
    function updateMontoPlazo() {
        var select = document.getElementById("monto_id");
        var montoInput = document.getElementById("monto");
        var plazoInput = document.getElementById("plazo");
        var selectedValue = select.value;
    
        for (var i = 0; i < montos.length; i++) {
            if (montos[i].id == selectedValue) {
                montoInput.value = '$' + montos[i].monto;
                plazoInput.value = montos[i].cantidad_plazos + ' plazos';
                document.getElementById("monto_id_text").textContent = selectedValue;
                break;
            }
        }
    }
    
    document.getElementById("cliente_id").addEventListener("change", function () {
        var clienteId = this.value;
        document.getElementById("cliente_id_text").textContent = clienteId;
    });

    document.getElementById("monto_id").addEventListener("change", updateMontoPlazo);
    
    updateMontoPlazo();
</script>

<?php
require_once("c://xampp/htdocs/phpTest/view/head/footer.php");
?>
