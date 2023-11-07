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

    public function index()
    {
        $stament = $this->PDO->prepare("
            SELECT 
                p.id AS prestamo_id,
                c.nombre AS nombre_cliente,
                c.id AS cliente_id,
                cm.monto AS monto_prestamo,
                cm.cantidad_plazos AS cantidad_plazos,
                p.fecha_inicio,
                p.interes,
                a.id,
                a.monto_pago,
                a.fecha_pago, 
                a.interes_pago,
                a.abono,
                a.quincena
            FROM prestamos p
            INNER JOIN cliente c ON p.cliente_id = c.id
            INNER JOIN catalogoMontos cm ON p.monto_id = cm.id
            Inner JOIN amortizaciones a ON p.id = a.prestamo_id
        ");
        return ($stament->execute()) ? $stament->fetchAll() : false;
    }

    
    public function searchAmortizacionesByNombre($searchTerm) {
        $stament = $this->PDO->prepare("
            SELECT
                c.id AS cliente_id,
                c.nombre AS nombre_cliente,
                cm.monto AS monto_prestamo,
                cm.cantidad_plazos AS cantidad_plazos,
                p.fecha_inicio,
                p.interes,
                p.id as prestamo_id,
                a.id,
                a.monto_pago,
                a.fecha_pago, 
                a.interes_pago,
                a.abono,
                a.quincena
            FROM prestamos p
            INNER JOIN cliente c ON p.cliente_id = c.id
            INNER JOIN catalogoMontos cm ON p.monto_id = cm.id
            Inner JOIN amortizaciones a ON p.id = a.prestamo_id
            WHERE c.nombre LIKE :searchTerm
        ");
        $searchTerm = '%' . $searchTerm . '%';
        $stament->bindParam(":searchTerm", $searchTerm, PDO::PARAM_STR);
        return ($stament->execute()) ? $stament->fetchAll() : false;
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
