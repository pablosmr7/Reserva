<?php

include ("view.php");
include ("models/security.php");
include ("models/user.php");
include ("models/timeTable.php");

class TimeTableController
{
    //******************************************************************************************************* */
    //-------------------------------------CONTROLADOR FRANJAS HORARIAS----------------------------------------
    //******************************************************************************************************* */


    private $view, $user, $timeTable;

    /**
     * Constructor. Crea el objeto vista y los modelos
     */
    public function __construct()
    {
        session_start(); // Si no se ha hecho en el index, claro
        $this->view = new View(); // Vistas
        $this->timeTable = new timeTable();
    }



	// --------------------------------- MOSTRAR LISTA DE FRANJAS ----------------------------------------

    public function mostrarTimeTable() {
        $id = $_SESSION["idUser"];
        $data['listaTimeTable'] = $this->timeTable->getAll();
        $this->view->show("timeTable/mostrarTimeTable", $data);
    }
    

	// --------------------------------- FORMULARIO INSERTAR RECURSOS ----------------------------------------

    public function formularioInsertarTimeTable() {
         if (Security::thereIsSession()==true) {
                $this->view->show('timeTable/formularioInsertarTimeTable');
         } else {
            Security::noAccess();
            }
     }

	// --------------------------------- INSERTAR RECURSOS ----------------------------------------

    public function insertarTimeTable() {
				
        if (Security::thereIsSession()==true) {

                    
             $result = $this->timeTable->insert();
            // echo ($result);
                if ($result == 1) {
                        // Tenemos que averiguar que idUsuario se ha asignado a la incidencia que acabamos de insertar
                   //$ultimoId = $this->timeTable->getLastId();
                    $data['msjInfo'] = "Franja horaria insertada con exito";
                } else {
                    // Si la insercion de la incidencia ha fallado, mostramos mensaje de error
                     $data['msjError'] = "Ha ocurrido un error al insertar la franja Horaria. Por favor, intentelo mas tarde.";
                }
                    $data['listaTimeTable'] = $this->timeTable->getAll();
                    $this->view->show("timeTable/mostrarTimeTable", $data);
    
                }else {
                    Security::noAccess();
                }	
            }

	// --------------------Elimina una Instalacion de la base de datos (petición por ajax)----------------------------

    public function borrarTimeTableAjax(){


            if (Security::thereIsSession()==true) {
                // Recuperamos el id de la Instalacion
                $id = $_REQUEST["id"];
                // Eliminamos la Instalacion de la BD
                $result = $this->timeTable->delete($id);
                if ($result == 0) {
                    // Error al borrar. Enviamos el código -1 al JS
                    echo "-1";
                }
                else {
                    // Borrado con éxito. Enviamos el id del libro a JS
                    $data['listaTimeTable'] = $this->timeTable->getAll();
                    $this->view->show("timeTable/mostrarTimeTable", $data);
                }
            } else {
                echo "-1";
            }
    }

	// --------------------------------- FORMULARIO MODIFICAR RESOURCES ----------------------------------------

	public function formularioModificarTimeTable() {
			if (Security::thereIsSession()==true) {

				$idUsuario = $_SESSION["idUser"];
				$id = $_REQUEST["id"];
				$data['timeTable'] = $this->timeTable->get($id);
				$this->view->show('timeTable/formularioModificarTimeTable', $data);
			} else {
				Security::noAccess();
			}
	}

// --------------------------------- MODIFICAR Resources ----------------------------------------

    public function modificarTimeTable() {

        if (Security::thereIsSession()==true) {

            //lanzamos la consulta pa la bd
         $result = $this->timeTable->update();
        
            if ($result == 1) {
            // Si la modificación del libro ha funcionado, continuamos actualizando la tabla "escriben".
                $data['msjInfo'] = "Franja horaaria actualizada con éxito";
            }else {
                $data['msjError'] = "Error al actualizar la franja Horaria";
            }
                $data['listaTimeTable'] = $this->timeTable->getAll();
                $this->view->show("timeTable/mostrarTimeTable", $data);
            } else {
                Security::noAccess();
            }
    }

	// --------------------------------- BUSCAR Resources ----------------------------------------

    public function buscarTimeTable() {
		// Recuperamos el texto de b�squeda de la variable de formulario
		$textoBusqueda = $_REQUEST["textoBusqueda"];
		// Lanzamos la búsqueda y enviamos los resultados a la vista de lista de incidencas
		$data['listaTimeTable'] = $this->timeTable->busquedaAproximada($textoBusqueda);
		$data['msjInfo'] = "Resultados de la búsqueda: \"$textoBusqueda\"";
		$this->view->show("timeTable/mostrarTimeTable", $data);
	}

	// ---------------------------------- CAMBIAR VALOR DE ORDENACION RECURSOS--------------------------------

	public function tipoBusquedaTimeTable(){
		// Recuperamos el texto de búsqueda de la variable de formulario
		$tipoBusqueda = $_REQUEST["tipoBusqueda"];
		// Lanzamos la búsqueda y enviamos los resultados a la vista de lista de incidencias
		$data['listaTimeTable'] = $this->timeTable->getOrder($tipoBusqueda);
		$data['msjInfo'] = "Busquedas ordenadas por: \"$tipoBusqueda\"";
		$this->view->show("timeTable/mostrarTimeTable", $data);
	}



}