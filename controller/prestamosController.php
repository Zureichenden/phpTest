<?php


    class prestamosController{
        private $model;
        public function __construct()
        {
            require_once("c://xampp/htdocs/phpTest/model/prestamosModel.php");
            $this->model = new prestamosModel();
        }

        public function guardar($cliente_id, $monto_id, $fecha_inicio, $interes)
        {
            require_once("c://xampp/htdocs/phpTest/model/catalogoMontosModel.php");
            require_once("c://xampp/htdocs/phpTest/model/amortizacionesModel.php");

            $id = $this->model->insertar($cliente_id, $monto_id, $fecha_inicio, $interes);

            if ($id !== false) {
                // Éxito al guardar el préstamo

                // Obtener el monto del préstamo y la cantidad de plazos del catálogo de montos
                $catalogoMontosModel = new CatalogoMontosModel();
                $montoPlazoInfo = $catalogoMontosModel->show($monto_id);

                if ($montoPlazoInfo) {
                    $montoPrestamo = $montoPlazoInfo['monto'];
                    $cantidadPlazos = $montoPlazoInfo['cantidad_plazos'];
                    
                    // Calcular el monto por quincena sin interés
                    $montoPorQuincenaSinInteres = $montoPrestamo / $cantidadPlazos;
                    
                    // Calcular la tasa de interés quincenal
                    $tasaInteresQuincenal = ($interes / 100);
                    
                    // Inicializa el monto total pagado
                    $montoTotalPagado = 0;
                    
                    // Llama al método para crear las amortizaciones
                    $amortizacionesModel = new AmortizacionesModel();
                    $quincena = 1;
                    $capitalPendiente = $montoPrestamo;
                    $fechaActual = new DateTime($fecha_inicio);

                    // Calcula el interés para esta quincena
                    $interesPago = $capitalPendiente * $tasaInteresQuincenal;
        
                    // Calcula el monto a pagar para esta quincena (capital + interés)
                    $abono = $montoPorQuincenaSinInteres + $interesPago;
            
                    while ($quincena <= $cantidadPlazos) {
               
                    
                        // Inserta la amortización
                        $amortizacionesModel->insertar($id, $quincena, $fechaActual->format('Y-m-d'), $capitalPendiente, $interesPago, $montoPorQuincenaSinInteres, $abono);
                    
                        // Actualiza los valores para la siguiente quincena
                        $capitalPendiente -= $montoPorQuincenaSinInteres;
                        $montoTotalPagado += $montoPago;
                        $quincena++;
                        $fechaActual->add(new DateInterval('P15D')); // Avanza 15 días (una quincena)
                    }
                    
                    // Ahora puedes usar $montoPorQuincenaSinInteres y $montoTotalPagado según sea necesario
                    

                    header("Location: show.php?id=" . $id);
                    exit;
                } else {
                    // Manejar el caso en el que no se pudo obtener la información del catálogo de montos
                    echo "Error al obtener la información del catálogo de montos.";
                }
            }
        }

    

        public function show($id){
            return ($this->model->show($id) != false) ? $this->model->show($id) : header("Location:index.php");
        }
        public function index(){
            return ($this->model->index()) ? $this->model->index() : false;
        }


        public function delete($id){
            return ($this->model->delete($id)) ? header("Location:index.php") : header("Location:show.php?id=".$id) ;
        }


        public function mostrarTablaAmortizacionCliente($cliente_id)
        {
            // Llama al modelo para obtener la tabla de amortización del cliente
            return ($this->model->mostrarTablaAmortizacionCliente($cliente_id)) ? header("Location:amortizacion.php") : header("Location:show.php?id=".$cliente_id) ;

        }

        public function mostrarTablaAmortizacionByPrestamo($id)
        {
            // Llama al modelo para obtener la tabla de amortización del cliente
            return ($this->model->mostrarTablaAmortizacionByPrestamo($id)) ?  $this->model->mostrarTablaAmortizacionByPrestamo($id) : [];

        }

      

        public function search($searchTerm) {
            $results = $this->model->searchClientesWithPrestamo($searchTerm);
            return $results;
        }
        

    }

?>