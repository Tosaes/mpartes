<?php
require_once "models/Usuario.php";

class LoginController {
    private $model;

    public function __construct(){
        $this->model = new Usuario();
    }

    public function index(){
        require "views/login/index.php";
    }

    public function acceder(){
        /*session_start();*/
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        $user = $this->model->login($usuario);

        if ($user && password_verify($clave, $user['clave'])) {
            $_SESSION['usuario'] = $user;

            if ($user['rol'] == 'admin') {
                header("Location: index.php?c=usuario&a=index");
            } else {
                header("Location: index.php?c=expediente&a=index");
            }
        } else {
            $error = "Usuario o contraseña incorrectos.";
            require "views/login/index.php";
        }
    }

    public function salir(){
        session_start();
        session_destroy();
        header("Location: index.php");
    }
}
