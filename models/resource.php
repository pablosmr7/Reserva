<?php
     include_once("DB.php");

    class Resource {
        private $db;

        public function __construct() {
            $this->db = new DB;
        }

        public function get($id) {
            
            $result = $this->db->consulta("SELECT * FROM resources WHERE resources.id = '$id'");
           
            return $result;

        }

        public function getAll() {
            $arrayResult = array();
            $result = $this->db->consulta("SELECT * FROM resources");
            
            return $result;

        }

        public function getOrder($tipoBusqueda) {
            $arrayResult = array();
            $result = $this->db->consulta("SELECT * FROM resources ORDER BY resources.$tipoBusqueda");
            
            return $result;
        }

        public function insert() {

            $name = $_REQUEST["name"];
            $description = $_REQUEST["description"];
            $location = $_REQUEST["location"];
            $dir_subida = 'imgs/resources/';
            $fichero_subido = $dir_subida . basename($_FILES['image']['name']);
	
            if (move_uploaded_file($_FILES['image']['tmp_name'], $fichero_subido)) {
               $result = $this->db->manipulacion("INSERT INTO resources (name,description,location,image) 
                        VALUES ('$name', '$description', '$location', '$fichero_subido')"); 

                if ($result != 1) {
                    unlink($fichero_subido);
                }
            } else {
                $result = -1;
            }
                
            return $result;
        }

        public function update() {

            $id = $_REQUEST["id"];
            $name = $_REQUEST["name"];
            $description = $_REQUEST["description"];
            $location = $_REQUEST["location"];
            //$imagen = $_REQUEST["imagen"];
            $dir_subida = 'imgs/resources/';
            $fichero_subido = $dir_subida . basename($_FILES['image']['name']);
      
            if (move_uploaded_file($_FILES['image']['tmp_name'], $fichero_subido)) {
                $result = $this->db->manipulacion("UPDATE resources SET name = '$name', description = '$description', location = '$location', image = '$fichero_subido' WHERE id = '$id'");
            } else if($fichero_subido == "imgs/resources/"){
                $result = $this->db->manipulacion("UPDATE resources SET name = '$name', description = '$description', location = '$location' WHERE id = '$id'");
            } else {
                $result = -1;
            }

            return $result;
        }

        public function delete($id) {
            $result = $this->db->manipulacion("DELETE FROM resources WHERE id = '$id'");
            return $result;
        }

        public function getLastId() {
            $result = $this->db->consulta("SELECT MAX(id) AS ultimoId FROM resources");
            $id = $result->ultimoId;
            return $id;
        }

        public function busquedaAproximada($textoBusqueda) {
            $arrayResult = array();
            // Buscamos los libros de la biblioteca que coincidan con el texto de búsqueda

            $result = $this->db->consulta("SELECT * FROM resources
                        WHERE resources.id LIKE '%$textoBusqueda%'
                        OR resources.name LIKE '%$textoBusqueda%'
                        OR resources.description LIKE '%$textoBusqueda%'
                        OR resources.location LIKE '%$textoBusqueda%'
                        ORDER BY resources.id");
            
            return $result;
        }
    }
