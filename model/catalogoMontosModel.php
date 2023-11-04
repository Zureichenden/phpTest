<?php
class catalogoMontosModel
{
    private $PDO;
    public function __construct()
    {
        require_once("c://xampp/htdocs/phpTest/config/db.php");
        $con = new db();
        $this->PDO = $con->conexion();
    }
    public function insertar($monto, $cantidad_plazos)
    {
        $stament = $this->PDO->prepare("INSERT INTO catalogomontos VALUES(null,:monto, :cantidad_plazos)");
        $stament->bindParam(":monto", $monto);
        $stament->bindParam(":cantidad_plazos", $cantidad_plazos);
        return ($stament->execute()) ? $this->PDO->lastInsertId() : false;
    }
    public function show($id)
    {
        $stament = $this->PDO->prepare("SELECT * FROM catalogomontos where id = :id limit 1");
        $stament->bindParam(":id", $id);
        return ($stament->execute()) ? $stament->fetch() : false;
    }
    public function index()
    {
        $stament = $this->PDO->prepare("SELECT * FROM catalogomontos");
        return ($stament->execute()) ? $stament->fetchAll() : false;
    }

    public function update($id, $monto, $cantidad_plazos)
    {
        $stament = $this->PDO->prepare("UPDATE catalogoMontos SET monto = :monto, cantidad_plazos = :cantidad_plazos WHERE id = :id");
        $stament->bindParam(":monto", $monto);
        $stament->bindParam(":cantidad_plazos", $cantidad_plazos);
        $stament->bindParam(":id", $id);
        return ($stament->execute()) ? $id : false;
    }

    public function delete($id)
    {
        $stament = $this->PDO->prepare("DELETE FROM catalogomontos WHERE id = :id");
        $stament->bindParam(":id", $id);
        return ($stament->execute()) ? true : false;
    }

    public function getMontosPlazos()
    {
        $sql = "SELECT id, monto, cantidad_plazos FROM catalogoMontos";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>