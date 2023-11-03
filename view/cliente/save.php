<?php
    require_once("c://xampp/htdocs/proyecto/controller/clienteController.php");
    $obj = new clienteController();
    $obj->guardar($_POST['nombre']);
?>