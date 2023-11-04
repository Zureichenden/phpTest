<?php
    require_once("c://xampp/htdocs/phpTest/controller/clienteController.php");
    $obj = new clienteController();
    $obj->update($_POST['id'],$_POST['nombre']);

?>