<?php

//print_r($data["recurso"]);

	// Comprobamos si hay una sesion iniciada o no
		echo "<h3>Realiza una reserva</h3>";


		echo "<form action = 'index.php' method = 'POST' enctype='multipart/form-data'>";

		echo"<div class='col-10'>";
			echo "<div class='form-group'>";

				// Creamos el formulario con los campos de la reserva, incluyendo recurso
				echo"<input type='hidden' name='resource' value='".$data["recurso"]. "'>";

				echo "<label for='fecha'>Selecciona un dia</label>
				<input type='date' class='form-control' id='fecha' name='date'><br>";

				// Finalizamos el formulario
				echo "  <input type='hidden' name='action' value='reservaPaso2'>
						<input type='hidden' name='controller' value='ReservationController'>
						<input type='submit' class='btn btn-primary' value='Continuar'>
				</form>";

			
			echo "</div>";
			echo "<p><a href='index.php?controller=ResourceController&action=mostrarResources&date=date' class='btn btn-warning'>Volver</a></p>";
			
		echo "</div>";
		