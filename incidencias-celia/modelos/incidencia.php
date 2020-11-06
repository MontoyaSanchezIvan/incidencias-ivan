<?php

    class Incidencia
    {

        private $db;

        /**
	        * Constructor. Crea la conexión con la base de datos
             * y la guarda en una variable de la clase
	     */

        public function __construct()
        {
            $this->db = new mysqli("localhost", "root", "", "incidencias-celia");
        }

        /**
	         * Busca una incidencia con id = $id en la base de datos.
             * @param id El id de la incidencia que se quiere buscar.
             * @return Un objeto con la incidencia de la BD, o null si no lo encuentra.
        */
        public function get($id)
    {
        if ($result = $this->db->query("SELECT * FROM incidencia
                                            WHERE incidencia.id = '$id'")) {
            $result = $result->fetch_object();
        } else {
            $result = null;
        }
        return $result;
    }

    /**
         * Consulta todas las incidencias de la BD.
         * @return Todas las incidencias como objetos de un array o null en caso de error.
         */
        public function getAll() {
            $arrayResult = array();
            if ($result = $this->db->query("SELECT * FROM incidencia")) {
                while ($fila = $result->fetch_object()) {
                    $arrayResult[] = $fila;
                }
            } else {
                $arrayResult = null;
            }
            return $arrayResult;
        }

    /**
         * Consulta todas las incidencias de un usuario en concreto.
         * @param id el ID del usuario del que queremos buscar sus incidencias.
         * @return Todas las incidencias como objetos de un array o null en caso de error.
         */
        public function getSelected($id) {
            $arrayReult = array();
            if ($result = $this->db->query("SELECT * FROM incidencia WHERE usuario_creador = '$id'")) {
                while ($fila = $result->fetch_object()) {
                    $arrayResult[] = $fila;
                }
            } else {
                $arrayResult = null;
            }
            return $arrayResult;
        }

        /*
        *actualizacion de una incidencia
        */

        public function update($id,$fecha_alta,$lugar,$equipo_afectado,$descripcion,$observaciones,$estado,$prioridad) {
            $this->db->query("UPDATE incidencia SET
                                                fecha_alta = '$fecha_alta',
                                                lugar = '$lugar',
                                                equipo_afectado = '$equipo_afectado',
                                                descripcion = '$descripcion',
                                                observaciones = '$observaciones',
                                                estado = '$estado',
                                                prioridad = '$prioridad'
                                                WHERE id = $id");
            return $this->db->affected_rows;
        }

        public function search($texto_busqueda,$campo_filtro,$orden_filtro) {
            $arrayResult = array();

            $query="SELECT * FROM incidencia
                            WHERE fecha_alta LIKE '%$texto_busqueda%'
                            OR lugar LIKE '%$texto_busqueda%'
                            OR equipo_afectado LIKE '%$texto_busqueda%'
                            OR descripcion LIKE '%$texto_busqueda%'
                            OR usuario_creador LIKE '%$texto_busqueda%'
                            OR observaciones LIKE '%$texto_busqueda%'
                            OR estado LIKE '%$texto_busqueda%'";
            if (!empty($campo_filtro) && !empty($orden_filtro)) {
               $query.=" ORDER BY ".$campo_filtro." ".$orden_filtro; 
            }


            if ($result = $this->db->query($query))
            {
                while ($fila = $result->fetch_object()) {
                    $arrayResult[] = $fila;
                }
            } else {
                $arrayResult = null;
            }

            return $arrayResult;
        }

        public function delete($id) {
            $this->db->query("DELETE FROM incidencia WHERE id = '$id'");
            return $this->db->affected_rows;
        }

        public function insert($id,$fecha_alta, $lugar, $equipo_afectado, $descripcion, $usuario_creador , $observaciones, $estado,$prioridad) {
            $this->db->query("INSERT INTO `incidencia` (`fecha_alta`, `lugar`, `equipo_afectado`, `descripcion`, `usuario_creador`, `observaciones`, `estado`,prioridad)
                                 VALUES ('$fecha_alta','$lugar','$equipo_afectado','$descripcion','$usuario_creador','$observaciones','$estado','$prioridad');");
            return $this->db->affected_rows;
        }

        
        
    }