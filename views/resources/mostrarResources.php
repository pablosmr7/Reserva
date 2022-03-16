<script>
	// **** Petición y respuesta AJAX con jQuery ****

	$(document).ready(function() {
		$("#btnBorrar").click(function() {
			alert("Salto")
			$.get("index.php?controller=ResourceController&action=borrarResourcesAjax&id=" + this.id, null, function(idBorrada) {
	
				if (idBorrada == "-1") {
					$('#msjError').html("Ha ocurrido un error al borrar el recurso");
				}
				else {
					$('#msjInfo').html("Recurso borrado con éxito");
					$('#resources' + idBorrada).remove();
				}
			});
		});
	});
</script>

<?php

	if (isset($data['msjError'])) {
		echo "<p style='color:red'>".$data['msjError']."</p>";
	}
	if (isset($data['msjInfo'])) {
		echo "<p style='color:blue'>".$data['msjInfo']."</p>";
	}
	
	echo "<div class=container>";
	

	echo"<h2> Recursos Disponibles</h2>";

	//if($_SESSION['type'] ==  "admin"){ 
	//	echo "<p><a href='index.php?controller=ResourceController&action=formularioInsertarResources' class='btn btn-success'>Nuevo</a></p>";
	//}

	// Primero, el formulario de busqueda
	if (Security::thereIsSession()==true){
		echo "<form action='index.php'>
				<input type='hidden' name='controller' value='ResourceController'>
				<input type='hidden' name='action' value='buscarResources'>

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
							echo"<a href='index.php?controller=ResourceController&action=formularioInsertarResources' class='btn btn-success'>Nuevo</a></td>";						
						}
					echo"</div>";

				
					
			echo"</form>";

					echo "</div>";
				echo "</div>";

		
	}

	if (count($data['listaResources']) > 0) {	


		// Ahora, la tabla con los datos de los libros
		echo "<div class=container>";

		echo "<div class= 'table-responsive-sm'>";
		echo "<table class= 'table table-hover'>";
			echo "<tr>";
				echo "<th>Imagen</th>";
				echo "<th>Nombre</th>";
				echo "<th>Reservas</th>";
				/*echo "<th>Descripcion</th>";
				echo "<th>Lugar</th>";*/

				if($_SESSION['type'] ==  "admin"){
					echo "<th colspan='2'>Opciones Admin</th>";
				}
            echo "</tr>";
            
			foreach($data['listaResources'] as $resources) {
				echo "<tr id='resources".$resources->id."'>";
					echo "<td> <img src=".$resources->image." width='80' height='80'></td>";
					echo "<td>".$resources->name."</td>";
					echo "<td><a href='index.php?controller=ReservationController&action=formularioInsertar&recurso=".$resources->id."' class='btn btn-primary'>Reservar</a></td>";
					/*echo "<td>".$resources->description."</td>";
					echo "<td>".$resources->location."</td>";*/	 
					
				

					if($_SESSION['type'] ==  "admin"){
						//echo "<td><a href='index.php?controller=ResourceController&action=formularioInsertarResources' class='btn btn-success'>Nuevo</a></td>";
						echo "<td><a href='index.php?controller=ResourceController&action=formularioModificarResources&id=".$resources->id."' class='btn btn-warning'>Modificar</a></td>";
						//echo "<td><a href='index.php?action=borrarResources&idResources=".$resources->id."'>Borrar</a></td>";
						echo "<td><button class='btn btn-danger'><a href='index.php?controller=ResourceController&action=borrarResourcesAjax&id=".$resources->id."' style='color: white'>Cancelar</button></a></td>";
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




	