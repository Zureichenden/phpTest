<?php
class AmortizacionesModel
{
    private $PDO;

    public function __construct()
    {
        require_once("c://xampp/htdocs/phpTest/config/db.php");
        $con = new db();
        $this->PDO = $con->conexion();
    }

    public function insertar($prestamo_id, $quincena, $fecha_pago, $capital_pendiente, $interes_pago, $monto_pago, $abono)
    {
        $stament = $this->PDO->prepare("INSERT INTO amortizaciones (prestamo_id, quincena, fecha_pago, capital_pendiente, interes_pago, monto_pago, abono) VALUES (:prestamo_id, :quincena, :fecha_pago, :capital_pendiente, :interes_pago, :monto_pago, :abono)");
        $stament->bindParam(":prestamo_id", $prestamo_id);
        $stament->bindParam(":quincena", $quincena);
        $stament->bindParam(":fecha_pago", $fecha_pago);
        $stament->bindParam(":capital_pendiente", $capital_pendiente);
        $stament->bindParam(":interes_pago", $interes_pago);
        $stament->bindParam(":monto_pago", $monto_pago);
        $stament->bindParam(":abono", $abono);

        return ($stament->execute()) ? $this->PDO->lastInsertId() : false;
    }

    public function getAmortizacionesByPrestamo($prestamo_id)
    {
        $stament = $this->PDO->prepare("SELECT * FROM amortizaciones WHERE prestamo_id = :prestamo_id");
        $stament->bindParam(":prestamo_id", $prestamo_id);
        return ($stament->execute()) ? $stament->fetchAll() : false;
    }

    public function getLastAmortizacionByPrestamo($prestamo_id)
    {
        $stament = $this->PDO->prepare("SELECT * FROM amortizaciones WHERE prestamo_id = :prestamo_id ORDER BY quincena DESC LIMIT 1");
        $stament->bindParam(":prestamo_id", $prestamo_id);
        return ($stament->execute()) ? $stament->fetch() : false;
    }

    public function getTotalAmortizacionesByPrestamo($prestamo_id)
    {
        $stament = $this->PDO->prepare("SELECT COUNT(*) FROM amortizaciones WHERE prestamo_id = :prestamo_id");
        $stament->bindParam(":prestamo_id", $prestamo_id);
        return ($stament->execute()) ? $stament->fetchColumn() : false;
    }

    // Otros métodos relacionados con las amortizaciones

}
?>
