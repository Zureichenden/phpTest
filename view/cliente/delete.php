<?php
    require_once("c://xampp/htdocs/proyecto/controller/clienteController.php");
    $obj = new clienteController();
    $obj->delete($_GET['id']);

?>