<script>
	// **** Petición y respuesta AJAX con jQuery ****

	$(document).ready(function() {
		$(".btnBorrar").click(function() {
			$.get("index.php?controller=UserController&action=borrarUserAjax&id=" + this.id, null, function(idBorrada) {
	
				if (idBorrada == "-1") {
					$('#msjError').html("Ha ocurrido un error al borrar el Usuario");
				}
				else {
					$('#msjInfo').html("Usuario borrado con éxito");
					$('#user' + idBorrada).remove();
				}
			});
		});
	});
</script>

<?php


	// Mostramos info del usuario logueado (si hay alguno)
	//if (Security::thereIsSession()==true) {
	//	echo "<p>Sesion iniciada como, ".$_SESSION['idUser']."</p>";
	//}
	// Mostramos mensaje de error o de informaci�n (si hay alguno)
	if (isset($data['msjError'])) {
		echo "<p style='color:red'>".$data['msjError']."</p>";
	}
	if (isset($data['msjInfo'])) {
		echo "<p style='color:blue'>".$data['msjInfo']."</p>";
	}

	echo "<div class=container>";

	echo "<h1> Usuarios Registrados</h1>";

	if (Security::thereIsSession()==true){
		echo "<form action='index.php'>
			<input type='hidden' name='controller' value='UserController'>
			<input type='hidden' name='action' value='buscarUser'>
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
					echo"<td><a href='index.php?controller=UserController&action=formularioInsertarUser' class='btn btn-success'>Nuevo</a></td>";
				}
			echo"</div>";}


	/*TAL VEZ ENTRA EN ESTA TABLA	
	if (Security::thereIsSession()==true) {
		echo "<form action = 'index.php' method = 'get'>
			Ordenar por: 
			<select name='tipoBusqueda'>
				<option value='username'>user</option>
				<option value='password'>password</option>
				<option value='realname'>real name</option>
			</select>
			<input type='hidden' name='controller' value='UserController'>
			<input type='hidden' name='action' value='tipoBusquedaUser'>
			<input type='submit' value='Ordenar'>";
	}*/

	echo "</div>";

	if (count($data['listaUser']) > 0) {


		// Ahora, la tabla con los datos de los libros
		echo "<div class=container>";
			echo "<div class= 'table-responsive'>";
				echo "<table class= 'table table-hover'>";
					echo "<tr>";
						echo "<th>User</th>";
						echo "<th>Password</th>";
						echo "<th>Username</th>";
						if (isset($_SESSION["idUser"])){
							echo "<th colspan='2'>Opciones</th>";
						}
					echo "</tr>";
					
					if($_SESSION['type'] ==  "user"){
						foreach($data['listaUser'] as $user) {
							if($user->id == $_SESSION["idUser"]){
							
							echo "<tr id='user".$user->id."'>";
								echo "<td>".$user->username."</td>";
								echo "<td>".$user->password."</td>";
								echo "<td>".$user->realname."</td>";
								
								echo "<td><a href='index.php?controller=UserController&action=formularioModificarUser&id=".$user->id."' class='btn btn-warning'>Modificar</a></td>";
								if($_SESSION['type'] ==  "admin"){
									//echo "<td><a href='index.php?action=borrarResources&idResources=".$resources->id."'>Borrar</a></td>";
									echo "<td><a href='index.php?controller=UserController&action=borrarResourcesAjax&id=".$user->id." class='btnBorrar'><button class='btn btn-danger'>Borrar</button></a></td>";								}
							echo "</tr>";
							}
						}
					}


					if($_SESSION['type'] ==  "admin"){
						foreach($data['listaUser'] as $user) {
							
							echo "<tr id='user".$user->id."'>";
								echo "<td>".$user->username."</td>";
								echo "<td>".$user->password."</td>";
								echo "<td>".$user->realname."</td>";
								
								echo "<td><a href='index.php?controller=UserController&action=formularioModificarUser&id=".$user->id."' class='btn btn-warning'> Modificar</a></td>";
								if($_SESSION['type'] ==  "admin"){
									//echo "<td><a href='index.php?action=borrarResources&idResources=".$resources->id."'>Borrar</a></td>";
									echo "<td><button class='btn btn-danger'><a href='index.php?controller=UserController&action=borrarUserAjax&id=".$user->id."' style='color: white'>Borrar</button></a></td>";
								}
									echo "</tr>";
						}
						
					}
				
				echo "</table>";
			echo "</div>";
		echo "</div>";
	} 
	else {
		// La consulta no contiene registros
		echo "No se encontraron datos";
	}


	// Enlace a "Iniciar sesion" o "Cerrar sesion"
	/*
	if (Security::thereIsSession()==true) {
		echo "<p><a href='index.php?controller=UserController&action=closeSession'>Cerrar sesion</a></p>";
	}
	else {
		echo "<p><a href='index.php?controller=UserController&action=showLoginForm'>Iniciar sesion</a></p>";
	}*/