<?php
// app/models/Usuario.php
class Usuario {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Encontrar usuario por nombre de usuario
    public function findUserByUsername($username){
        $this->db->query('SELECT * FROM usuarios WHERE nombre_usuario = :username');
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    // Iniciar sesión
    public function login($username, $password){
        $row = $this->findUserByUsername($username);

        if($row){
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row; // Retorna el objeto del usuario
            }
        }
        return false;
    }
}
