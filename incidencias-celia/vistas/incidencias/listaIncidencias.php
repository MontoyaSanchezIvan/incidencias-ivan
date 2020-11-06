<?php
	echo "<h1>Incidencias Celia</h1>";
	// Mostramos info del usuario logueado (si hay alguno)
	if (isset($_SESSION['id'])) {
		echo "<p class ='nombre_usuario'>Hola, ".$_SESSION['nombre']."</p>";
	}
	// Mostramos mensaje de error o de información (si hay alguno)
	if (isset($data['msjError'])) {
		echo "<p style='color:red'>".$data['msjError']."</p>";
	}
	if (isset($data['msjInfo'])) {
		echo "<p style='color:blue'>".$data['msjInfo']."</p>";
	}

	// Enlace a "Iniciar sesión" o "Cerrar sesión"
	if (isset($_SESSION["id"])) {
		echo "<p><a href='index.php?action=cerrarSesion'>Cerrar sesión</a></p>";
	}
	else {
		echo "<p><a href='index.php?action=mostrarFormularioLogin'>Iniciar sesión</a></p>";
	}
	// Primero, el formulario de búsqueda para el administrador 
	// para poder buscar las incidencias mas facil
	if ($_SESSION['tipo']==0) {
		echo "<form action='index.php'>
			<input type='hidden' name='action' value='buscarIncidencia'>
			   <input type='text' name='textoBusqueda'>
			   <label>Ordenar por: </label>
			   <select name='campo_filtro'> 
					<option value=''>- </option>
					<option value='fecha_alta'>Fecha alta </option>
					<option value='lugar'>Lugar </option>
					<option value='equipo_afectado'>Equipo Afectado </option>
					<option value='usuario_creador'>Usuario Creador </option>
					<option value='estado'>Estado </option>
					<option value='prioridad'>Prioridad</option>
				</select>
				<label> En orden: </label>
			   <select name='orden_filtro'> 
					<option value=''>- </option>
					<option value='desc'>Descentiente </option>
					<option value='asc'>Ascendente </option>
				</select>
			<input type='submit' value='Buscar/Ordenar'>
			</form><br>";
	}

	echo"<table class='tabla'  cellspacing='3' cellpadding='5' border='0' bgcolor='#A4C4D0' text-algin='centre'> 
			<thead>
				<tr>
					<td style='font-size:25px'>Fecha Alta</td>
					<td style= 'font-size:25px'>Lugar Incidencia</td>
					<td style='font-size:25px'>Equipo Afectado</td>
					<td style='font-size:25px'>Descripcion</td>
					<td style='font-size:25px'>Observaciones</td>
					<td style='font-size:25px'>Estado</td>";

					// Si el usuario registrado es el admin
					// Le mostraremos el usuaruio que creeo la incidencia
		
					if ($_SESSION['tipo'] == 0) {
						echo "<td style=' font-size:25px'> Usuario Creador</td>";
						echo "<td style=' font-size:25px' colspan='2'> Prioridad </td>";
						
					}
				
		echo"	</tr>";	
		echo"</thead>";			
		echo"<tbody>";
		foreach ($data['listaIncidencias'] as $incidencia ) {
			echo"<tr name='incidencia'>";
			echo"	 <td style='display:none;'>".$incidencia ->id. "</td>";
			echo"	 <td >".$incidencia ->fecha_alta. "</td>";
			echo"	 <td>".$incidencia ->lugar ."</td>";
			echo"	 <td>".$incidencia ->equipo_afectado ."</td>";
			echo"	 <td>".$incidencia ->descripcion ."</td>";
			echo"	 <td>".$incidencia ->observaciones ."</td>";
			echo"	 <td>".$incidencia ->estado ."</td>";
			if ($_SESSION['tipo'] == 0) {
			echo"	 <td class='usuario_creador'>".$incidencia->usuario_creador."<td>";	
			echo"	 <td>".$incidencia->prioridad."<td>";
			echo "<td><a href='index.php?action=borrarIncidencia&id=" . $incidencia->id."'>Borrar</a></td>";
			
			echo "<td><a href='index.php?action=formularioModificarIncidencias&id=".$incidencia->id."'> modificar</td>";
			}
		echo"</tr>";	
		}
		
		echo "</tbody>";
		
	echo "</table>"; 
	
 echo "<p class='nueva_incidencia'><a href='index.php?action=formularioInsertarIncidencia&id ==".$incidencia->id."'> Crear Nueva incidencia</a></p> ";
	

	

	
	
	
	
	
