<?php
class Expediente {
    private $pdo;

    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=mpartes;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }



    public function getAll(){
        $sql = "SELECT * FROM expediente ORDER BY fecha_recibido DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getById($ano_eje, $nro_expediente){
        $sql = "SELECT * FROM expediente WHERE ano_eje = ? AND nro_expediente = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$ano_eje, $nro_expediente]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function create($data){
        $sql = "INSERT INTO expediente 
                (ano_eje, nro_expediente, tipo_documento, nro_documento, asunto, nro_folio, fecha_recibido, firmado_por, entidad_remite, idoficina, doc_adjunto)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['ano_eje'],
            $data['nro_expediente'],
            $data['tipo_documento'],
            $data['nro_documento'],
            $data['asunto'],
            $data['nro_folio'],
            $data['fecha_recibido'],
            $data['firmado_por'],
            $data['entidad_remite'],
            $data['idoficina'],
            $data['doc_adjunto']
        ]);
    }



    public function update($data){
        $sql = "UPDATE expediente SET tipo_documento=?, nro_documento=?, asunto=?, nro_folio=?, fecha_recibido=?, firmado_por=?, entidad_remite=?, idoficina=?, doc_adjunto=?
                WHERE ano_eje=? AND nro_expediente=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['tipo_documento'],
            $data['nro_documento'],
            $data['asunto'],
            $data['nro_folio'],
            $data['fecha_recibido'],
            $data['firmado_por'],
            $data['entidad_remite'],
            $data['idoficina'],
            $data['doc_adjunto'],
            $data['ano_eje'],
            $data['nro_expediente']
        ]);
    }



    public function delete($ano_eje, $nro_expediente){
        $sql = "DELETE FROM expediente WHERE ano_eje=? AND nro_expediente=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$ano_eje, $nro_expediente]);
    }



    
    // Obtener el próximo ID auto-incremental
    public function obtenerSiguienteNumero(){
    $sql = "SELECT MAX(nro_expediente) AS maximo FROM expediente";
    $stmt = $this->pdo->query($sql);
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si la tabla está vacía, comenzar desde 1
    $siguiente = ($fila['maximo']) ? $fila['maximo'] + 1 : 1;
    return $siguiente;
    }



    // Obtener lista de oficinas
    public function getOficinas() {
        $query = "SELECT idoficina, oficina FROM oficinas ORDER BY oficina ASC";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    // Paginacion con búsqueda
    public function listarPaginado($inicio, $limite, $busqueda = null){
    if ($busqueda) {
        $sql = "SELECT * FROM expediente 
                WHERE nro_expediente LIKE :busqueda 
                   OR tipo_documento LIKE :busqueda 
                   OR asunto LIKE :busqueda 
                   OR firmado_por LIKE :busqueda
                ORDER BY nro_expediente DESC 
                LIMIT :inicio, :limite";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':busqueda', "%$busqueda%", PDO::PARAM_STR);
    } else {
        $sql = "SELECT * FROM expediente ORDER BY nro_expediente DESC LIMIT :inicio, :limite";
        $stmt = $this->pdo->prepare($sql);
    }

    $stmt->bindValue(':inicio', (int)$inicio, PDO::PARAM_INT);
    $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}





public function contarExpedientes($busqueda = null){
    if ($busqueda) {
        $sql = "SELECT COUNT(*) AS total FROM expediente 
                WHERE nro_expediente LIKE :busqueda 
                   OR tipo_documento LIKE :busqueda 
                   OR asunto LIKE :busqueda 
                   OR firmado_por LIKE :busqueda";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':busqueda', "%$busqueda%", PDO::PARAM_STR);
        $stmt->execute();
    } else {
        $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM expediente");
    }

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

}




    


