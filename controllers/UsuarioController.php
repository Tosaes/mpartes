<?php
require_once "models/Usuario.php";

class UsuarioController {
    private $model;

    public function __construct(){
        /*session_start();*/
        if(!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin'){
            header("Location: index.php");
            exit;
        }
        $this->model = new Usuario();
    }

    /*public function index(){
        $usuarios = $this->model->getAll();
        require "views/usuario/index.php";
    }*/

    
    public function index() {
    $usuarios = $this->model->getAll();
    $vista = "views/usuario/index.php";
    require "views/layouts/admin.php";
    }

    public function crear(){
        require "views/usuario/crear.php";
    }

    public function guardar(){
        $this->model->create($_POST);
        header("Location: index.php?c=usuario&a=index");
    }

    public function editar(){
        $usuario = $this->model->getById($_GET['id']);
        require "views/usuario/editar.php";
    }

    public function actualizar(){
        $this->model->update($_POST);
        header("Location: index.php?c=usuario&a=index");
    }

    public function eliminar(){
        $this->model->delete($_GET['id']);
        header("Location: index.php?c=usuario&a=index");
    }
}
