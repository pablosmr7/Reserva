<script>
	// **** Petición y respuesta AJAX con jQuery ****

	$(document).ready(function() {
		$(".btnBorrar").click(function() {
			$.get("index.php?controller=TimeTableController&action=borrarTimeTableAjax&id=" + this.id, null, function(idBorrada) {
	
				if (idBorrada == "-1") {
					$('#msjError').html("Ha ocurrido un error al borrar la franja horaria");
				}
				else {
					$('#msjInfo').html("Franja horaria borrada con éxito");
					$('#timeTable' + idBorrada).remove();
				}
			});
		});
	});
</script>

<?php


	// Mostramos mensaje de error o de informaci�n (si hay alguno)
		if (isset($data['msjError'])) {
			echo "<p style='color:red'>".$data['msjError']."</p>";
		}
		if (isset($data['msjInfo'])) {
			echo "<p style='color:blue'>".$data['msjInfo']."</p>";
		}
			
		echo "<div class=container>";

			echo "<h1> Franjas Horarias</h1>";			
			// Primero, el formulario de busqueda
			if (Security::thereIsSession()==true){
				echo "<form action='index.php'>
						<input type='hidden' name='controller' value='TimeTableController'>
						<input type='hidden' name='action' value='buscarTimeTable'>

						<div class='col-13'>
						BUSCAR POR:
						<div class='input-group mb-3'>
							<input type='text'class='form-control' name='textoBusqueda' aria-label='' aria-describedby='basic-addon2'>
							<div class='input-group-btn'>
								<button class='btn btn-outline-secondary' type='submit' value='Buscar'>
									Buscar
									</button>
							</div>";
						if($_SESSION['type'] ==  "admin"){
							echo"<td><a href='index.php?controller=TimeTableController&action=formularioInsertarTimeTable' class='btn btn-success'>Nuevo</a></td>";
						}
					echo"</div>";}


			/*if (Security::thereIsSession()==true) {
				echo "<form action = 'index.php' method = 'get'>
					Ordenar por: 
					<select name='tipoBusqueda'>
						<option value='dayOfWeek'>Día</option>
						<option value='starTime'>Hora Inicio</option>
						<option value='endTime'>Hora Final</option>
					</select>
					<input type='hidden' name='controller' value='TimeTableController'>
					<input type='hidden' name='action' value='tipoBusquedaTimeTable'>
					<input type='submit' value='Ordenar'>";
			}
			*/
			echo"</div>";

			if (count($data['listaTimeTable']) > 0) {
				// Ahora, la tabla con los datos los tiempos
				echo "<div class=container>";
					echo "<div class= 'table-responsive'>";
					echo "<table class= 'table table-hover'>";
						echo "<tr>";
							echo "<th>Día</th>";
							echo "<th>Hora Comienzo</th>";
							echo "<th>Hora Final</th>";
							if($_SESSION['type'] ==  "admin"){
								echo "<th colspan='2'>Opciones</th>";
							}
						echo "</tr>";
						
						foreach($data['listaTimeTable'] as $timeTable) {
							echo "<tr id='timeTable".$timeTable->id."'>";
								
							switch ($timeTable->dayOfWeek) {
								case "1":
									echo "<td>LUNES</td>";
									break;
								case "2":
									echo "<td>MARTES</td>";
									break;
								case "3":
									echo "<td>MIERCOLES</td>";
									break;
								case "4":
									echo "<td>JUEVES</td>";
									break;
								case "5":
									echo "<td>VIERNES</td>";
									break;
							}

								echo "<td>".$timeTable->starTime."</td>";
								echo "<td>".$timeTable->endTime."</td>";
								if($_SESSION['type'] ==  "admin"){
									echo "<td><a href='index.php?controller=TimeTableController&action=formularioModificarTimeTable&id=".$timeTable->id."' class='btn btn-warning'>Modificar</a></td>";
									//echo "<td><a href='index.php?action=borrarResources&idResources=".$resources->id."'>Borrar</a></td>";
									echo "<td><button class='btn btn-danger'><a href='index.php?controller=TimeTableController&action=borrarTimeTableAjax&id=".$timeTable->id." class='btnBorrar' style='color: white'>Borrar</button></a></td>";
									
								}
							echo "</tr>";
						}
					
				echo "</table>";
			echo "</div>";
		echo "</div>";
	} 

	else {
		// La consulta no contiene registros
		echo "No se encontraron datos";
	}

