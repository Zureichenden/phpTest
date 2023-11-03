<?php
    require_once("c://xampp/htdocs/proyecto/controller/clienteController.php");
    $obj = new clienteController();
    $obj->update($_POST['id'],$_POST['nombre']);

?>