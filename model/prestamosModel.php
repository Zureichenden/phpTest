<?php
class prestamosModel
{
    private $PDO;
    public function __construct()
    {
        require_once("c://xampp/htdocs/phpTest/config/db.php");
        $con = new db();
        $this->PDO = $con->conexion();
    }
    public function insertar($cliente_id, $monto_id, $fecha_inicio, $interes)
    {
        $stament = $this->PDO->prepare("INSERT INTO prestamos (cliente_id, monto_id, fecha_inicio, interes) VALUES (:cliente_id, :monto_id, :fecha_inicio, :interes)");
        $stament->bindParam(":cliente_id", $cliente_id);
        $stament->bindParam(":monto_id", $monto_id);
        $stament->bindParam(":fecha_inicio", $fecha_inicio);
        $stament->bindParam(":interes", $interes);
        return ($stament->execute()) ? $this->PDO->lastInsertId() : false;
    }

    public function show($id)
    {
        $statement = $this->PDO->prepare("SELECT p.*, c.nombre AS nombre_cliente, cm.monto AS monto_prestamo, cm.cantidad_plazos FROM prestamos p
        INNER JOIN cliente c ON p.cliente_id = c.id
        INNER JOIN catalogoMontos cm ON p.monto_id = cm.id
        WHERE p.id = :id LIMIT 1");
    
        $statement->bindParam(":id", $id);
    
        return ($statement->execute()) ? $statement->fetch() : false;
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
                p.interes
            FROM prestamos p
            INNER JOIN cliente c ON p.cliente_id = c.id
            INNER JOIN catalogoMontos cm ON p.monto_id = cm.id
        ");
        return ($stament->execute()) ? $stament->fetchAll() : false;
    }


    public function indexNoJoins()
    {
        $stament = $this->PDO->prepare("SELECT * FROM prestamos");
        return ($stament->execute()) ? $stament->fetchAll() : false;
    }

    public function delete($id)
    {
        $stament = $this->PDO->prepare("DELETE FROM prestamos WHERE id = :id");
        $stament->bindParam(":id", $id);
        return ($stament->execute()) ? true : false;
    }

    public function mostrarTablaAmortizacionCliente($cliente_id)
    {
        $stament = $this->PDO->prepare("
            SELECT 
                a.quincena AS NO_PAGO,
                a.fecha_pago AS FECHA,
                a.monto_pago AS PAGO,
                a.interes_pago AS INTERES,
                (a.monto_pago + a.interes_pago) AS ABONO
            FROM amortizaciones a
            INNER JOIN prestamos p ON a.prestamo_id = p.id
            WHERE p.cliente_id = :cliente_id
        ");
        $stament->bindParam(":cliente_id", $cliente_id);
        return ($stament->execute()) ? $stament->fetchAll() : false;
    }

    public function mostrarTablaAmortizacionByPrestamo2($id)
    {
        $stament = $this->PDO->prepare("
            SELECT 
            a.quincena AS NO_PAGO,
            a.fecha_pago AS FECHA,
            a.monto_pago AS PAGO,
            a.interes_pago AS INTERES,
            (a.monto_pago + a.interes_pago) AS ABONO
            FROM amortizaciones a
            INNER JOIN prestamos p ON a.prestamo_id = p.id
            WHERE p.id = 5
        ");
        // $stament->bindParam(":id", $id);
        return ($stament->execute()) ? $stament->fetchAll() : false;
    }

    public function mostrarTablaAmortizacionByPrestamo($id)
    {
        $statement = $this->PDO->prepare("
        SELECT 
        p.id as prestamo_id, 
        a.id as amortizacion_id,  
        a.quincena AS NO_PAGO, 
        a.fecha_pago as fecha, 
        a.monto_pago as monto_pago, 
        a.interes_pago as interes, 
        a.abono as abono, 
        c.nombre AS nombre_cliente, 
        cm.monto AS monto_prestamo, 
        cm.cantidad_plazos 
        FROM prestamos p
        INNER JOIN cliente c ON p.cliente_id = c.id
        INNER JOIN catalogoMontos cm ON p.monto_id = cm.id
        INNER JOIN amortizaciones a ON p.id = a.prestamo_id
        WHERE p.id = :id");
        $statement->bindParam(":id", $id);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }

    public function searchClientesWithPrestamo($searchTerm) {
        $stament = $this->PDO->prepare("
            SELECT
                c.id AS cliente_id,
                c.nombre AS nombre_cliente,
                cm.monto AS monto_prestamo,
                cm.cantidad_plazos AS cantidad_plazos,
                p.fecha_inicio,
                p.interes,
                p.id as prestamo_id
            FROM prestamos p
            INNER JOIN cliente c ON p.cliente_id = c.id
            INNER JOIN catalogoMontos cm ON p.monto_id = cm.id
            WHERE c.nombre LIKE :searchTerm
        ");
        $searchTerm = '%' . $searchTerm . '%';
        $stament->bindParam(":searchTerm", $searchTerm, PDO::PARAM_STR);
        return ($stament->execute()) ? $stament->fetchAll() : false;
    }
    

}

?>