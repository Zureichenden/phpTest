<?php
require_once("c://xampp/htdocs/phpTest/controller/prestamosController.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $obj = new prestamosController();
    $cliente_id = $_POST['cliente_id'];
    $monto_id = $_POST['monto_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $interes = $_POST['interes'];

    // Llama al método para guardar el préstamo con los valores
    $resultado = $obj->guardar($cliente_id, $monto_id, $fecha_inicio, $interes);

    if ($resultado) {
        // Éxito al guardar el préstamo
        header("Location: index.php");
        exit;
    } else {
        // Error al guardar el préstamo
        echo "Error al guardar el préstamo.";
    }
} else {
    // Si no es una solicitud POST, redirige a la página del formulario
    header("Location: create.php");
    exit;
}
?>
