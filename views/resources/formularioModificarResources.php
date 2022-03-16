<?php

$resources = $data['resources'][0];

echo "<h1>Modificar Recurso</h1>";
      

echo"<form action = 'index.php' method = 'POST' enctype='multipart/form-data'>
        <div class='col-10'>
                <input type='hidden' name='id' value='$resources->id'>

                <div class='form-group'>
                <label for='name2'>Nombre del recurso</label>
                <input type='text' name='name' value='$resources->name' class='form-control' id='name2' aria-describedby='emailHelp' placeholder='Nombre Recurso'>
                </div>

                <div class='form-group'>
                <label for='desc'>Descripcion</label>
                <input type='text' name='description' value='$resources->description' class='form-control' id='desc' placeholder='Descripcion'>
                </div>

                <div class='form-group'>
                <label for='local'>Localizacion</label>
                <input input type='text' name='location' value='$resources->location' class='form-control' id='local' placeholder='Lugar'>
                </div>

                <div class='form-group'>
                <label for='img'>Imagen</label><img src=".$resources->image." width='80' height='80'>
                <input type='file' name='image' value='$resources->image' class='form-control' id='img' placeholder='Imagen del recurso'>
                </div>

                <div class='form-group'>
                <input type='hidden' name='action' value='modificarResources'>
                <input type='hidden' name='controller' value='ResourceController'>
                <button type='submit' class='btn btn-primary'>Añadir Recurso</button>
                </div>

                <p><a href='index.php?controller=ResourceController&action=mostrarResources' class='btn btn-warning'>Volver</a></p>
        </div>
  </form>";


?>