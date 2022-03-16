<?php

include ("view.php");
include ("models/security.php");
include ("models/user.php");
include ("models/resource.php");

class ResourceController
{
    //******************************************************************************************************* */
    //----------------------------------------CONTROLADOR RESOURCES---------------------------------------------
    //******************************************************************************************************* */


    private $view, $user, $resources;

    /**
     * Constructor. Crea el objeto vista y los modelos
     */
    public function __construct()
    {
        session_start(); // Si no se ha hecho en el index, claro
        $this->view = new View(); // Vistas
        $this->resources = new Resource();
    }



	// --------------------------------- MOSTRAR LISTA DE RECURSOS ----------------------------------------

    public function mostrarResources() {
        $id = $_SESSION["idUser"];
        $data['listaResources'] = $this->resources->getAll();
        $this->view->show("resources/mostrarResources", $data);
    }
    

	// --------------------------------- FORMULARIO INSERTAR RECURSOS ----------------------------------------

    public function formularioInsertarResources() {
         if (Security::thereIsSession()==true) {
                $this->view->show('resources/formularioInsertarResources');
         } else {
            Security::noAccess();
            }
     }

	// --------------------------------- INSERTAR RECURSOS ----------------------------------------

    public function insertarResources() {
				
        if (Security::thereIsSession()==true) {

                    
             $result = $this->resources->insert();
            // echo ($result);
                if ($result == 1) {
                        // Tenemos que averiguar que idUsuario se ha asignado a la incidencia que acabamos de insertar
                    //$ultimoId = $this->resources->getLastId();
                    $data['msjInfo'] = "Instalacion insertada con exito";
                } else {
                    // Si la insercion de la incidencia ha fallado, mostramos mensaje de error
                     $data['msjError'] = "Ha ocurrido un error al insertar la instalacion. Por favor, intentelo mas tarde.";
                }
                    $data['listaResources'] = $this->resources->getAll();
                    $this->view->show("resources/mostrarResources", $data);
    
                }else {
                    Security::noAccess();
                }	
            }

	// --------------------Elimina una Instalacion de la base de datos (petición por ajax)----------------------------

    public function borrarResourcesAjax(){


            if (Security::thereIsSession()==true) {
                // Recuperamos el id de la Instalacion
                $id = $_REQUEST["id"];
                // Eliminamos la Instalacion de la BD
                $result = $this->resources->delete($id);
                if ($result == 0) {
                    // Error al borrar. Enviamos el código -1 al JS
                    echo "-1";
                }
                else {
                    // Borrado con éxito. Enviamos el id del libro a JS
                    $data['listaResources'] = $this->resources->getAll();
                    $this->view->show("resources/mostrarResources", $data);
                }
            } else {
                echo "-1";
            }
    }

	// --------------------------------- FORMULARIO MODIFICAR RESOURCES ----------------------------------------

	public function formularioModificarResources() {
			if (Security::thereIsSession()==true) {

				$idUsuario = $_SESSION["idUser"];
				$id = $_REQUEST["id"];
				$data['resources'] = $this->resources->get($id);
				$this->view->show('resources/formularioModificarResources', $data);
			} else {
				Security::noAccess();
			}
	}

// --------------------------------- MODIFICAR Resources ----------------------------------------

    public function modificarResources() {

        if (Security::thereIsSession()==true) {

            //lanzamos la consulta pa la bd
         $result = $this->resources->update();
        
            if ($result == 1) {
            // Si la modificación del libro ha funcionado, continuamos actualizando la tabla "escriben".
                $data['msjInfo'] = "Recurso actualizado con éxito";
            }else {
                $data['msjError'] = "Error al actualizar el recurso";
            }
                $data['listaResources'] = $this->resources->getAll();
                $this->view->show("resources/mostrarResources", $data);
            } else {
                Security::noAccess();
            }
    }

	// --------------------------------- BUSCAR Resources ----------------------------------------

    public function buscarResources() {
		// Recuperamos el texto de b�squeda de la variable de formulario
		$textoBusqueda = $_REQUEST["textoBusqueda"];
		// Lanzamos la búsqueda y enviamos los resultados a la vista de lista de incidencas
		$data['listaResources'] = $this->resources->busquedaAproximada($textoBusqueda);
		$data['msjInfo'] = "Resultados de la búsqueda: \"$textoBusqueda\"";
		$this->view->show("resources/mostrarResources", $data);
	}

	// ---------------------------------- CAMBIAR VALOR DE ORDENACION RECURSOS--------------------------------

	public function tipoBusquedaResources(){
		// Recuperamos el texto de búsqueda de la variable de formulario
		$tipoBusqueda = $_REQUEST["tipoBusqueda"];
		// Lanzamos la búsqueda y enviamos los resultados a la vista de lista de incidencias
		$data['listaResources'] = $this->resources->getOrder($tipoBusqueda);
		$data['msjInfo'] = "Busquedas ordenadas por: \"$tipoBusqueda\"";
		$this->view->show("resources/mostrarResources", $data);
	}



}