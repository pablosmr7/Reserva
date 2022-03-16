<script>
	// **** Petición y respuesta AJAX con jQuery ****
	$(document).ready(function() {
		$(".btnBorrar").click(function() {
			$.get("index.php?controller=ReservationController&action=borrarReservationAjax&id=" + this.id, null, function(idBorrada) {
	
				if (idBorrada == "-1") {
					$('#msjError').html("Ha ocurrido un error al borrar la reserva");
				}
				else {
					$('#msjInfo').html("Reserva eliminada con éxito");
					$('#reservation' + idBorrada).remove();
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
	echo"<h2> Mis Reservas</h2>";

	// Primero, el formulario de busqueda
	if (Security::thereIsSession()==true){

		echo "<form action='index.php'>
				<input type='hidden' name='controller' value='ReservationController'>
				<input type='hidden' name='action' value='buscar'>

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
						echo"<td><a href='index.php?controller=ResourceController&action=formularioInsertarResources' class='btn btn-success'>Nuevo</a></td>";
					}
					echo"</div>";

				
					
			echo"</form>";
	}
		echo "</div>";
	echo "</div>";


	if (count($data['listaReservation']) > 0) {
		// Ahora, la tabla con los datos de los libros
		echo "<div class=container>";

		echo "<div class= 'table-responsive-sm'>";
		echo "<table class= 'table table-hover'>";
			echo "<tr>";
				echo "<th>Recurso</th>";
				if($_SESSION['type'] ==  "admin"){
					echo "<th>Usuario</th>";
				}
				echo "<th>Hora Inicio</th>";
				echo "<th>Fecha</th>";
				echo "<th>Observaciones</th>";
				
					echo "<th colspan='2'>Opciones</th>";
				
            echo "</tr>";
            



				foreach($data['listaReservation'] as $reservation) {

					
					echo "<tr id='reservation".$reservation->id."'>";
						
						echo "<td>".$reservation->name."</td>";
						if($_SESSION['type'] ==  "admin"){
							echo "<td>".$reservation->username."</td>";
						}
						echo "<td>".$reservation->starTime."</td>";     
						echo "<td>".$reservation->date."</td>";
						echo "<td>".$reservation->remarks."</td>";

						echo "<td><button class='btn btn-danger'><a href='index.php?controller=ReservationController&action=borrarReservationAjax&id=".$reservation->id."' style='color: white'>Cancelar</button></a></td>";
						if($_SESSION['type'] ==  "admin"){
							echo "<td><a href='index.php?controller=ReservationController&action=formularioModificar&id=".$reservation->id."' class='btn btn-warning'>Modificar</a></td>";
							//echo "<td><a href='index.php?action=borrarResources&idResources=".$resources->id."'>Borrar</a></td>";
							
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
