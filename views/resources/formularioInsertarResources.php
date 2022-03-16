<?php

	// Comprobamos si hay una sesion iniciada o no
		echo "<h1>Alta Recursos</h1>";

		// Creamos el formulario con los campos del libro
		/*echo "<form action = 'index.php' method = 'POST' enctype='multipart/form-data'>
				Nombre:<input type='text' name='name'><br>
				Descripcion:<input type='text' name='description'><br>
				Lugar:<input type='text' name='location'><br>
				Imagen:<input type='file' name='image'><br>";*/

		echo"<form action = 'index.php' method = 'POST' enctype='multipart/form-data'>
			<div class='col-10'>
				<div class='form-group'>
				<label for='name2'>Nombre del recurso</label>
				<input type='text' name='name' class='form-control' id='name2' aria-describedby='emailHelp' placeholder='Nombre Recurso'>
				</div>

				<div class='form-group'>
				<label for='desc'>Descripcion</label>
				<input type='text' name='description' class='form-control' id='desc' placeholder='Descripcion'>
				</div>

				<div class='form-group'>
				<label for='local'>Localizacion</label>
				<input input type='text' name='location' class='form-control' id='local' placeholder='Lugar'>
				</div>

				<div class='form-group'>
				<label for='img'>Imagen</label>
				<input type='file' name='image' class='form-control' id='img' placeholder='Imagen del recurso'>
				</div>
				<div class='form-group'>
				<input type='hidden' name='action' value='insertarResources'>
				<input type='hidden' name='controller' value='ResourceController'>
				<button type='submit' class='btn btn-primary'>Añadir Recurso</button>
				</div>

				<p><a href='index.php?controller=ResourceController&action=mostrarResources'class='btn btn-warning'>Volver</a></p>
				
			</div>

	  	</form>";

	
		

		// Finalizamos el formulario
		/*echo "  <input type='hidden' name='action' value='insertarResources'>
				<input type='hidden' name='controller' value='ResourceController'>
				<input type='submit'>
			</form>";*/
