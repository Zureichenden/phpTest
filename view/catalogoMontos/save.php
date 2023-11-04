<?php
    require_once("c://xampp/htdocs/phpTest/controller/catalogoMontosController.php");
    $obj = new catalogoMontosController();
    $obj->guardar($_POST['monto'],$_POST['cantidad_plazos']);
?>