<?php
    class prestamosController{
        private $model;
        public function __construct()
        {
            require_once("c://xampp/htdocs/phpTest/model/prestamosModel.php");
            $this->model = new prestamosModel();
        }
        public function guardar2($monto, $cantidad_plazos){
            $id = $this->model->insertar($monto, $cantidad_plazos);
            return ($id!=false) ? header("Location:show.php?id=".$id) : header("Location:create.php");
        }

        public function guardar($cliente_id, $monto_id, $fecha_inicio, $interes)
        {
            $id = $this->model->insertar($cliente_id, $monto_id, $fecha_inicio, $interes);
            return ($id != false) ? header("Location: show.php?id=".$id) : header("Location: create.php");
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
            return ($this->model->mostrarTablaAmortizacionCliente($cliente_id)) ? header("Location:index.php") : header("Location:show.php?id=".$cliente_id) ;

        }

    }

?>