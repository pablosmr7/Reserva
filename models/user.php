<?php


     include_once("DB.php");
class User {

    private $db;

    /**
     * Constructor de la clase.
     * Crea una conexión con la base de datos y la asigna a la variable $this->db
     */
    public function __construct()
    {
        $this->db = new DB;
    }

    /**
     * Comprueba si un email y una password pertenecen a algún usuario de la base  de datos.
     * @param String $email El email del usuario que se quiere comprobar
     * @param String $pass La contraseña del usuario que se quiere comprobar
     * @return User $usuario Si el usuario existe, devuelve un objeto con todos los campos del usuario en su interior. Si no, devuelve un objeto null
     */
    public function checkLogin($username, $password)
    {
        $result = $this->db->consulta("SELECT * FROM users WHERE username = '$username' AND password = '$password'"); 
            return $result;

    }



    public function get($id) {
            
        $result = $this->db->consulta("SELECT * FROM users WHERE users.id = '$id'");
       
        return $result;

    }

    public function getAll() {
        $arrayResult = array();
        $result = $this->db->consulta("SELECT * FROM users");
        
        return $result;

    }

    public function getOrder($tipoBusqueda) {
        $arrayResult = array();
        $result = $this->db->consulta("SELECT * FROM users ORDER BY users.$tipoBusqueda");
        
        return $result;
    }

    public function insert() {

        $username = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $realname = $_REQUEST["realname"];
        
      
        $result = $this->db->manipulacion("INSERT INTO users (username,password,realname) 
            VALUES ('$username', '$password', '$realname')"); 

            return $result;
    }

    public function update() {

        $id = $_REQUEST["id"];
        $username = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $realname = $_REQUEST["realname"];
  
        $result = $this->db->manipulacion("UPDATE users SET username = '$username', password = '$password', realname = '$realname' WHERE id = '$id'");

        return $result;
    }

    public function delete($id) {
        $result = $this->db->manipulacion("DELETE FROM users WHERE id = '$id'");
        return $result;
    }

   /* public function getLastId() {
        $result = $this->db->consulta("SELECT MAX(id) AS ultimoId FROM users");
        $id = $result->ultimoId;
        return $id;
    }*/

    public function busquedaAproximada($textoBusqueda) {
        $arrayResult = array();
        // Buscamos los libros de la biblioteca que coincidan con el texto de búsqueda

        $result = $this->db->consulta("SELECT * FROM users
                    WHERE users.id LIKE '%$textoBusqueda%'
                    OR users.username LIKE '%$textoBusqueda%'
                    OR users.password LIKE '%$textoBusqueda%'
                    OR users.realname LIKE '%$textoBusqueda%'
                    ORDER BY users.id");
        
        return $result;
    }


}
?>