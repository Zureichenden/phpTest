<?php
    class catalogoMontosController{
        private $model;
        public function __construct()
        {
            require_once("c://xampp/htdocs/phpTest/model/catalogoMontosModel.php");
            $this->model = new catalogoMontosModel();
        }
        public function guardar($monto, $cantidad_plazos){
            $id = $this->model->insertar($monto, $cantidad_plazos);
            return ($id!=false) ? header("Location:show.php?id=".$id) : header("Location:create.php");
        }
        public function show($id){
            return ($this->model->show($id) != false) ? $this->model->show($id) : header("Location:index.php");
        }
        public function index(){
            return ($this->model->index()) ? $this->model->index() : false;
        }

        public function update($id, $monto, $cantidad_plazos){
            return ($this->model->update($id,$monto, $cantidad_plazos) != false) ? header("Location:show.php?id=".$id) : header("Location:index.php");
        }
        public function delete($id){
            return ($this->model->delete($id)) ? header("Location:index.php") : header("Location:show.php?id=".$id) ;
        }
    }

?>