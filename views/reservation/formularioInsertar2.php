<?php

	$idResource = $_POST['resource'];

	$fecha=date($_POST['date']);
	$trueDay = date('w', strtotime($_POST['date']));
	$trueDate = $_POST['date'];

	//print_r($idResource);
	//print_r($trueDay);



	// Comprobamos si hay una sesion iniciada o no
		echo "<h3>Realiza una reserva</h3>";


		// Creamos el formulario con los campos del libro
		echo"<div class='col-11'>";
			echo "<form action = 'index.php' method = 'POST' enctype='multipart/form-data'>";
				echo"<div class='form-group'>";
					echo"<input type='hidden' name='idResource' value='$idResource'>";

					echo "<div class='form-group'>
						<label for='tramHora'>Tramos Horarios disponibles</label>
							<select name='idTimeTable' class='form-control form-control-sm' id='tramoHora'>";
							foreach($data['timeTable'] as $timeTable ) {

								if ($timeTable->dayOfWeek == $trueDay){
									if (array_search($timeTable->id, $data['time2']) === false) {
									echo"<option name='idTimeTable' value='" . $timeTable->id . "'>&bull; "  . $timeTable->starTime . "-" . $timeTable->endTime . "</option>";
								}else{
									echo "<option disabled name='idTimeTable' value='" . $timeTable->id . "'>&bull; "  . $timeTable->starTime . "-" . $timeTable->endTime . "</option>";
								}
							}

						}
							echo "</select>";

						

					echo"<input type='hidden' name='date' value='$trueDate'></br>

					<label for='observaciones'>Observaciones</label>
					<input type='text' class='form-control form-control-sm' name='remarks' id='observaciones' placeholder='Escribe aqui'>
					</div>"; 		


				// Finalizamos el formulario
					echo "  <input type='hidden' name='action' value='insertar'>
							<input type='hidden' name='controller' value='ReservationController'>
							<input type='submit' class='btn btn-primary' value='Finalizar Reserva'></br>

					</div>
					<p><a href='index.php?controller=ReservationController&action=formularioInsertar&date=date'class='btn btn-warning'>Volver</a></p>
				</form>
			</div>";

	