<?php
    require_once("c://xampp/htdocs/phpTest/controller/clienteController.php");
    $obj = new clienteController();
    $obj->guardar($_POST['nombre']);
?>