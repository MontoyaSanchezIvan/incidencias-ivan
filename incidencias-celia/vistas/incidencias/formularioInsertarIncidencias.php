<?php
	if (isset($_SESSION['id'])) {
		echo"<h1 class='text-centre'>Crear incidencia</h1>";
		echo"<form action='index.php' method='get'>
				Fecha Alta: <br> <input type='date' name='fecha_alta'><br>
				Lugar: <br> <input type='text' name='lugar'> <br>
				Equipo afectado: <br><input type='text' name='equipo_afectado'><br></br>
				<textarea name='descripcion'>Descripción</textarea><br>
				Usuario: </br><input type='number' name='usuario_creador'></input><br>
				<textarea name='observaciones'>Observaciones</textarea><br></br>
				<select name='estado'>
					<option value='abierto'>Abierto</option>
					<option value='en espera'>En espera</option>
					<option value='cerrado'>Cerrado</option>
				</select><br><br>
				<select name='prioridad'>
					<option value='alta'>Alta</option>
					<option value='media'>Media</option>
					<option value='baja'>Baja</option>
				</select><br><br>
				<input type='hidden' name='action' value='nuevaIncidencia'>
				<input type='submit' value='Crear incidencia'>
			</form>";

	}
