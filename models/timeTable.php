<?php

    include_once("DB.php");

    class TimeTable {
        private $db;

        public function __construct() {
            $this->db = new DB;
        }

        public function get($id) {
            
            $result = $this->db->consulta("SELECT * FROM timeslots WHERE timeslots.id = '$id'");
           
            return $result;

        }

        public function getAll() {
            $arrayResult = array();
            $result = $this->db->consulta("SELECT * FROM timeslots ORDER BY timeslots.id");
            
            return $result;
        }


        public function getAvailable() {
            $arrayResult = array();
            $fecha=$_POST['date'];
            $resource=$_POST['resource'];

            $result = $this->db->consulta("SELECT idTimeSlot FROM reservations
                WHERE reservations.idResource='$resource'
                AND reservations.date='$fecha'");

            $resultArray = array();
            foreach ($result as $fila) {
                $resultArray[] = $fila->idTimeSlot;
            }
            
            return $resultArray;

        }






        public function getOrder($tipoBusqueda) {
            $arrayResult = array();
            $result = $this->db->consulta("SELECT * FROM timeslots ORDER BY timeslots.$tipoBusqueda");
            
            return $result;
        }

        public function insert() {

            $dayOfWeek = $_REQUEST["dayOfWeek"];
            $starTime = $_REQUEST["starTime"];
            $endTime = $_REQUEST["endTime"];


            $result = $this->db->manipulacion("INSERT INTO timeslots (dayOfWeek,starTime,endTime) 
                VALUES ('$dayOfWeek', '$starTime', '$endTime')"); 


            return $result;
        }

        public function update() {

            $id = $_REQUEST["id"];
            $dayOfWeek = $_REQUEST["dayOfWeek"];
            $starTime = $_REQUEST["starTime"];
            $endTime = $_REQUEST["endTime"];
            //$imagen = $_REQUEST["imagen"];

            $result = $this->db->manipulacion("UPDATE timeslots SET dayOfWeek = '$dayOfWeek', starTime = '$starTime', endTime = '$endTime' WHERE id = '$id'");

            return $result;
        }

        public function delete($id) {
            $result = $this->db->manipulacion("DELETE FROM timeslots WHERE id = '$id'");
            return $result;
        }

        /*public function getLastId() {
            $result = $this->db->consulta("SELECT MAX(id) AS ultimoId FROM resources");
            $id = $result->ultimoId;
            return $id;
        }*/

        public function busquedaAproximada($textoBusqueda) {
            $arrayResult = array();
            // Buscamos los libros de la biblioteca que coincidan con el texto de búsqueda

            $result = $this->db->consulta("SELECT * FROM timeslots
                        WHERE timeslots.dayOfWeek LIKE '%$textoBusqueda%'


                        ORDER BY timeslots.id");
            
            return $result;
        }
    }
