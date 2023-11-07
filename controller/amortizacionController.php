<?php


    class amortizacionController{
        private $model;
        public function __construct()
        {
            require_once("c://xampp/htdocs/phpTest/model/amortizacionesModel.php");
            $this->model = new AmortizacionesModel();
        }

        public function show($id){
            return ($this->model->show($id) != false) ? $this->model->show($id) : header("Location:index.php");
        }
        public function index(){
            return ($this->model->index()) ? $this->model->index() : false;
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
            $results = $this->model->searchAmortizacionesByNombre($searchTerm);
            return $results;
        }

    }

?>