<?php

require_once "models/Expediente.php";

class ExpedienteController {
    private $model;
    private $uploadDir = "uploads/";
    private $db;

    
    public function __construct(){
        $this->model = new Expediente();
    }


    public function index(){
        if(!isset($_SESSION['usuario'])){
            header("Location: index.php");
            exit;
        }

        $limite = 10;
        $pagina = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($pagina < 1) $pagina = 1;

        $busqueda = isset($_GET['q']) ? trim($_GET['q']) : '';
        $inicio = ($pagina - 1) * $limite;

        $totalRegistros = $this->model->contarExpedientes($busqueda);
        $totalPaginas = ceil($totalRegistros / $limite);

        $data = $this->model->listarPaginado($inicio, $limite, $busqueda);

        $vista = "views/expediente/index.php";
        /*require "views/layouts/admin.php";*/
        require "views/expediente/index.php";
    }




public function crear(){
    $siguienteNumero = $this->model->obtenerSiguienteNumero();
    $oficinas = $this->model->getOficinas(); // 🔹 obtener lista de oficinas
    $vista = "views/expediente/crear.php";
    require "views/expediente/crear.php";
}




public function guardar(){
    $data = $_POST;

    // Subir archivo adjunto si existe
    $archivo = "";
    if (!empty($_FILES['doc_adjunto']['name'])) {
        $archivo = basename($_FILES['doc_adjunto']['name']);
        move_uploaded_file($_FILES['doc_adjunto']['tmp_name'], "uploads/" . $archivo);
    }
    $data['doc_adjunto'] = $archivo;

    $this->model->create($data);
    header("Location: index.php?c=expediente&a=index");
}




public function editar(){
    $ano_eje = $_GET['ano_eje'];
    $nro_expediente = $_GET['nro_expediente'];
    $expediente = $this->model->getById($ano_eje, $nro_expediente);
    $oficinas = $this->model->getOficinas(); // 🔹 obtener lista de oficinas
    require "views/expediente/editar.php";
}



public function actualizar(){
    $data = $_POST;

    // Si hay nuevo archivo, reemplazar
    if (!empty($_FILES['doc_adjunto']['name'])) {
        $archivo = basename($_FILES['doc_adjunto']['name']);
        move_uploaded_file($_FILES['doc_adjunto']['tmp_name'], "uploads/" . $archivo);
        $data['doc_adjunto'] = $archivo;
    } else {
        // Mantener el existente
        $exp = $this->model->getById($data['ano_eje'], $data['nro_expediente']);
        $data['doc_adjunto'] = $exp['doc_adjunto'];
    }

    $this->model->update($data);
    header("Location: index.php?c=expediente&a=index");
}



public function eliminar(){
    $ano_eje = $_GET['ano_eje'];
    $nro_expediente = $_GET['nro_expediente'];
    $this->model->delete($ano_eje, $nro_expediente);
    header("Location: index.php?c=expediente&a=index");
}

    
}
?>
