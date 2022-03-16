<!DOCTYPE html> 
<html lang="es-ES"> 
<head>

    
    <title>Gestor Reservas</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Ajax-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!--Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>


<body>

    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> 

<?php
    if (Security::thereIsSession()) {
       echo" <a class='navbar-brand' href='index.php?controller=ReservationController&action=mostrar&date=date' >Mis Reservas</a>

        <div class='collapse navbar-collapse' id='navbarTogglerDemo03'>
            <ul class='navbar-nav mr-auto mt-2 mt-lg-0'>

                <li class='nav-item active'>
                    <a class='nav-link' href='index.php?controller=ResourceController&action=mostrarResources'>Recursos</a>
                   
                </li>";

                /* <!--<li class='nav-item'>
                    <a class='nav-link' href=''>Usuarios</a>
                </li>--> */
            if($_SESSION['type'] ==  "admin"){   
            echo"<li class='nav-item'>
                    <a class='nav-link' href='index.php?controller=TimeTableController&action=mostrarTimeTable'>Franjas Horarias</a>  
                </li>";
            }


            echo"</ul>";
        }
?>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if (Security::thereIsSession()) {
                        echo "<li><a class='nav-link' href='index.php?controller=UserController&action=mostrarUser' ><i class='bi bi-person-circle'></i>".$_SESSION['realname']."</a></li>";
                        echo "<li><a class='nav-link' href='index.php?controller=UserController&action=closeSession'><i class='bi bi-box-arrow-right'></i> Cerrar sesión</a></li>";
                    }else {
                        echo "<li><a class='nav-link' href='index.php?controller=UserController&action=showLoginForm'><span class='glyphicon glyphicon-log-in'></span> Iniciar sesion</a></li>";
                    }
                ?>
            </ul>
            </div>
        </div>
       
    </nav>
                
    </br>










  
