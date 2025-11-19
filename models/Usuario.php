<?php
class Usuario {
    private $pdo;

    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=mpartes;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAll(){
        $stmt = $this->pdo->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    
    public function getById($id){
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data){
        $sql = "INSERT INTO usuarios (nombres, email, usuario, clave, rol) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['nombres'],
            $data['email'],
            $data['usuario'],
            password_hash($data['clave'], PASSWORD_DEFAULT),
            $data['rol']
        ]);
    }

    public function update($data){
        $sql = "UPDATE usuarios SET nombres=?, email=?, usuario=?, rol=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['nombres'],
            $data['email'],
            $data['usuario'],
            $data['rol'],
            $data['id']
        ]);
    }

    public function delete($id){
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id=?");
        $stmt->execute([$id]);
    }

    public function login($usuario){
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario=?");
        $stmt->execute([$usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
