<?php
     include_once("DB.php");

    class Reservation {
        private $db;

        public function __construct() {
            $this->db = new DB;
        }



        public function getModify($id) {
            
            $result = $this->db->consulta("SELECT * FROM reservations WHERE reservations.id = '$id'");
           
            return $result;

        }


        public function get() {
            $id = $_SESSION["idUser"];
            //$result = $this->db->consulta("SELECT * FROM reservations WHERE reservations.idUser = '$id'");
            $arrayResult = array();
            $result = $this->db->consulta("SELECT reservations.id, resources.name, users.username, timeslots.starTime, reservations.date, reservations.remarks
             FROM reservations, resources, users, timeslots
                WHERE reservations.idResource = resources.id
                AND reservations.idUser = users.id
                AND reservations.idTimeslot = timeslots.id
                AND reservations.idUser = '$id'");
           
            return $result;
        }


        public function getAll() {
            $arrayResult = array();
            $result = $this->db->consulta("SELECT reservations.id, resources.name, users.username, timeslots.starTime, reservations.date, reservations.remarks
             FROM reservations, resources, users, timeslots
                WHERE reservations.idResource = resources.id
                AND reservations.idUser = users.id
                AND reservations.idTimeslot = timeslots.id");
            
            return $result;
        }


        public function getOrder($tipoBusqueda) {
            $arrayResult = array();
            $result = $this->db->consulta("SELECT * FROM reservations ORDER BY reservations.$tipoBusqueda");
            
            return $result;
        }


        public function insert() {
            $idResource = $_REQUEST["idResource"];

            $idUser = Security::getUserId();
            $idTimeSlot = $_REQUEST["idTimeTable"];
            $idTimeFin = $idTimeSlot[0];
            
            $date = $_REQUEST["date"];
            $remarks = $_REQUEST["remarks"];
	

            $result = $this->db->manipulacion("INSERT INTO reservations (idResource,idUser,idTimeSlot,date,remarks) 
                VALUES ('$idResource', '$idUser', '$idTimeFin', '$date', '$remarks')"); 

            //print_r("INSERT INTO reservations (idResource,idUser,idTimeSlot,date,remarks) 
            //VALUES ('$idResource', '$idUser', '$idTimeSlot', '$date', '$remarks'))");


            return $result;
        }


        public function update() {

            $id = $_REQUEST["id"];
            $idResource = $_REQUEST["idResource"];
            $idUser = $_REQUEST["idUser"];
            $idTimeSlot = $_REQUEST["idTimeSlot"];
            $date = $_REQUEST["date"];
            $remarks = $_REQUEST["remarks"];


            $result = $this->db->manipulacion("UPDATE reservations SET idResource = '$idResource', idUser = '$idUser', idTimeSlot = '$idTimeSlot', date = '$date', remarks = '$remarks' WHERE id = '$id'");

            return $result;
        }

        public function delete($id) {
            $result = $this->db->manipulacion("DELETE FROM reservations WHERE id = '$id'");
            return $result;
        }

        public function getLastId() {
            $result = $this->db->consulta("SELECT MAX(id) AS ultimoId FROM reservations");
            $id = $result->ultimoId;
            return $id;
        }

        public function busquedaAproximada($textoBusqueda) {
            $arrayResult = array();
            // Buscamos los libros de la biblioteca que coincidan con el texto de búsqueda

            $result = $this->db->consulta("SELECT * FROM reservations
                        WHERE reservations.idResource LIKE '%$textoBusqueda%'
                        OR reservations.idUser LIKE '%$textoBusqueda%'
                        OR reservations.idTimeSlot LIKE '%$textoBusqueda%'
                        OR reservations.date  LIKE '%$textoBusqueda%'
                        OR reservations.remarks  LIKE '%$textoBusqueda%'
                        ORDER BY resources.id");
            
            return $result;
        }
    }
