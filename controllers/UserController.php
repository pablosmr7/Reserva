<?php

include ("view.php");
include ("models/security.php");
include ("models/user.php");
include ("models/resource.php");


class UserController {

    
    //******************************************************************************************************* */
    //-----------------------------------CONTROLADOR USER------------------------------------------------------
    //******************************************************************************************************* */
    


    public function __construct()
    {
        session_start(); // Si no se ha hecho en el index, claro
        $this->view = new View(); // Vistas
        $this->user = new User();
        $this->resources = new Resource();
    }



    
    public function showMainMenu()
    {
        $id = $_SESSION["idUser"];
        $data['listaResources'] = $this->resources->getAll();
        $this->view->show("resources/mostrarResources", $data);
    }





    //-----------------------------------------LOGIN FORM & PROCESS---------------------------------------------------------

    public function showLoginForm()
    {
        $this->view->show("user/loginForm");
    }

    /**
     * Procesa el formulario de login y, si es correcto, inicia la sesión con el id del usuario.
     * Redirige a la vista de selección de rol.
     */
    public function processLoginForm()
    {

        // Validación del formulario
        if (Security::filter($_REQUEST['username']) == "" || Security::filter($_REQUEST['password']) == "") {
            // Algún campo del formulario viene vacío: volvemos a mostrar el login
            $data['errorMsg'] = "El email y la contraseña son obligatorios";
            $this->view->show("user/loginForm", $data);
        }
        else {
            // Hemos pasado la validación del formulario: vamos a procesarlo
            $username = Security::filter($_REQUEST['username']);
            $password = Security::filter($_REQUEST['password']);
            $userData = $this->user->checkLogin($username, $password);
           // print_r ($userData);
            if ($userData!=null) {
                // Login correcto: creamos la sesión
                Security::createSession($userData[0]);
                $this->showMainMenu();
            }
            else {
                $data['errorMsg'] = "Usuario o contraseña incorrectos";
                $this->view->show("user/loginForm", $data);
            }
        }
    }




    //------------------------------------------CERRAR SESION-------------------------------------------------------- 
    public function closeSession() {
        Security::closeSession();
        $this->view->show("user/loginForm");
    }





    // --------------------------------- MOSTRAR LISTA DE USUARIOS ----------------------------------------

    public function mostrarUser() {
        $id = $_SESSION["idUser"];
        $data['listaUser'] = $this->user->getAll();
        $this->view->show("user/mostrarUser", $data);
    }
    

	// --------------------------------- FORMULARIO INSERTAR USUARIOS ----------------------------------------

    public function formularioInsertarUser() {
         if (Security::thereIsSession()==true) {
                $this->view->show('user/formularioInsertarUser');
         } else {
            Security::noAccess();
            }
     }

	// --------------------------------- INSERTAR USUARIOS ----------------------------------------

    public function insertarUser() {
				
        if (Security::thereIsSession()==true) {

                    
             $result = $this->user->insert();
             //echo ($result);
                if ($result == 1) {
                        // Tenemos que averiguar que idUsuario se ha asignado a la incidencia que acabamos de insertar
                    $data['msjInfo'] = "Usuario insertado con exito";
                } else {
                    // Si la insercion de la incidencia ha fallado, mostramos mensaje de error
                     $data['msjError'] = "Ha ocurrido un error al insertar el usuario. Por favor, intentelo mas tarde.";
                }
                    $data['listaUser'] = $this->user->getAll();
                    $this->view->show("user/mostrarUser", $data);
    
                }else {
                    Security::noAccess();
                }	
            }

	// --------------------Elimina un USUARIO de la base de datos (petición por ajax)----------------------------

    public function borrarUserAjax(){


            if (Security::thereIsSession()==true) {
                // Recuperamos el id de la Instalacion
                $id = $_REQUEST["id"];
                // Eliminamos la Instalacion de la BD
                $result = $this->user->delete($id);
                if ($result == 0) {
                    // Error al borrar. Enviamos el código -1 al JS
                    echo "-1";
                }
                else {
                    // Borrado con éxito. Enviamos el id del libro a JS
                    $data['listaUser'] = $this->user->getAll();
                    $this->view->show("user/mostrarUser", $data);
                }
            } else {
                echo "-1";
            }
    }

	// --------------------------------- FORMULARIO MODIFICAR USER ----------------------------------------

	public function formularioModificarUser() {
			if (Security::thereIsSession()==true) {

				$idUsuario = $_SESSION["idUser"];
				$id = $_REQUEST["id"];
				$data['user'] = $this->user->get($id);
				$this->view->show('user/formularioModificarUser', $data);
			} else {
				Security::noAccess();
			}
	}

// --------------------------------- MODIFICAR USERs ----------------------------------------

    public function modificarUser() {

        if (Security::thereIsSession()==true) {

            //lanzamos la consulta pa la bd
         $result = $this->user->update();
        
            if ($result == 1) {
            // Si la modificación del libro ha funcionado, continuamos actualizando la tabla "escriben".
                $data['msjInfo'] = "Usuario actualizado con éxito";
            }else {
                $data['msjError'] = "Error al actualizar el usuario";
            }
                $data['listaUser'] = $this->user->getAll();
                $this->view->show("user/mostrarUser", $data);
            } else {
                Security::noAccess();
            }
    }

	// --------------------------------- BUSCAR User ----------------------------------------

    public function buscarUser() {
		// Recuperamos el texto de b�squeda de la variable de formulario
		$textoBusqueda = $_REQUEST["textoBusqueda"];
		// Lanzamos la búsqueda y enviamos los resultados a la vista de lista de incidencas
		$data['listaUser'] = $this->user->busquedaAproximada($textoBusqueda);
		$data['msjInfo'] = "Resultados de la búsqueda: \"$textoBusqueda\"";
		$this->view->show("user/mostrarUser", $data);
	}

	// ---------------------------------- CAMBIAR VALOR DE ORDENACION RECURSOS--------------------------------

	public function tipoBusquedaUser(){
		// Recuperamos el texto de búsqueda de la variable de formulario
		$tipoBusqueda = $_REQUEST["tipoBusqueda"];
		// Lanzamos la búsqueda y enviamos los resultados a la vista de lista de incidencias
		$data['listaUser'] = $this->user->getOrder($tipoBusqueda);
		$data['msjInfo'] = "Busquedas ordenadas por: \"$tipoBusqueda\"";
		$this->view->show("user/mostrarUser", $data);
	}


    public function mainMenu() {

        $this->view->show("resources/mostrarResources", $data);
    }



}