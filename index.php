<?php

// Miramos a ver si hay algún controlador indicado en la URL
if (!isset($_REQUEST['controller'])) {
    // No lo hay. Usamos el controlador por defecto
        $controller = "UserController";
    } else {
    // Si lo hay. Lo recuperamos.
        $controller = $_REQUEST['controller'];
    }
    


// Miramos a ver si hay alguna acci�n pendiente de realizar
if (!isset($_REQUEST['action'])) {
    // No la hay. Usamos la acci�n por defecto (mostrar el formulario de login)
        $action = "showLoginForm";
    } else {
    // S� la hay. La recuperamos.
        $action = $_REQUEST['action'];
    }
    
//$controller = "UserController";

include("controllers/$controller.php");

$controller = new $controller();

// Ejecutamos el m�todo del controlador que se llame como la acci�n
$controller->$action();
