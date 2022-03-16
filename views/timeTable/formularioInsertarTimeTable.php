<?php

	// Comprobamos si hay una sesion iniciada o no
		echo "<h1>Alta Franjas Horarias</h1>";

		// Creamos el formulario con los campos del libro


		echo"<form action = 'index.php' method = 'POST' enctype='multipart/form-data'>
			<div class='col-10'>
				<div class='form-group'>
				<label for='name2'>Dia de la semana</label>
				<input type='text' name='dayOfWeek' class='form-control' id='name2' aria-describedby='emailHelp' placeholder='1,2,3,4,5'>
				</div>

				<div class='form-group'>
				<label for='desc'>Franja Inicio</label>
				<input <input type='text' name='starTime'class='form-control' id='desc' placeholder='10:00:00'>
				</div>

				<div class='form-group'>
				<label for='local'>Franja Final</label>
				<input input type='text' name='endTime' class='form-control' id='local' placeholder='11:00:00'>
				</div>

				<div class='form-group'>
				<input type='hidden' name='action' value='insertarTimeTable'>
				<input type='hidden' name='controller' value='TimeTableController'>
				<button type='submit' class='btn btn-primary'>Añadir Franja Horaria</button>
				</div>

				<p><a href='index.php?controller=TimeTableController&action=mostrarTimeTable' class='btn btn-warning'>Volver</a></p>
			</div>
		</form>";
		

		// Finalizamos el formulario

		echo "";