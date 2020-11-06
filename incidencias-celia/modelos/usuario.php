<?php
    class Usuario {
        private $db;
        
        /**
         * Constructor. Establece la conexión con la BD y la guarda
         * en una variable de la clase
         */
        public function __construct() {
            $this->db = new mysqli("localhost", "root", "", "incidencias-celia");
        }

       
        /**
         * Busca un usuario por nombre de usuario y password
         * @param usuario El nombre del usuario
         * @param password La contraseña del usuario
         * @return True si existe un usuario con ese nombre y contraseña, false en caso contrario
         */
        public function buscarUsuario($correo,$pass) {

            if ($result = $this->db->query("SELECT id, nombre,correo, pass, tipo FROM usuario WHERE correo = '$correo' AND pass = '$pass'")) {
                if ($result->num_rows == 1) {
                    $usuario = $result->fetch_object();
                    // Iniciamos la sesión
                    $_SESSION["id"] = $usuario->id;
                    $_SESSION["nombre"] = $usuario->nombre;
                   $_SESSION["tipo"] = $usuario-> tipo;
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        }

        public function get($id) {
            if ($result = $this->db->query("SELECT * FROM users WHERE id = '$id'")) {
                $result = $result->fetch_object();
            } else {
                $result = null;
            }

            return $result;
        }

        public function getAll() {
        }

        public function insert() {
        }

        public function update() {
        }

        public function delete() {
        }


    }