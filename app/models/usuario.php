<?php
// Agregar estos métodos al archivo app/models/usuario.php

class Usuario {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Métodos existentes...
    public function findUserByUsername($username){
        $this->db->query('SELECT * FROM usuarios WHERE nombre_usuario = :username');
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    public function login($username, $password){
        $row = $this->findUserByUsername($username);
        if($row){
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row;
            }
        }
        return false;
    }

    // NUEVOS MÉTODOS PARA REGISTRO SIMPLIFICADO

    // Verificar disponibilidad de username
    public function isUsernameAvailable($username){
        $this->db->query('SELECT id FROM usuarios WHERE nombre_usuario = :username');
        $this->db->bind(':username', $username);
        $result = $this->db->single();
        return !$result; // true si está disponible
    }

    // Registrar nuevo usuario (versión simplificada)
    public function register($data){
        $this->db->query('INSERT INTO usuarios (nombre_usuario, password, nombre_completo, rol) 
                         VALUES (:username, :password, :nombre_completo, :rol)');
        
        // Bind values
        $this->db->bind(':username', $data['nombre_usuario']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':nombre_completo', $data['nombre_completo']);
        $this->db->bind(':rol', $data['rol']);
        
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // Obtener usuario por ID
    public function getUserById($id){
        $this->db->query('SELECT * FROM usuarios WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}