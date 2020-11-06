<?php
// Pasamos las variables preparadas en el controlador ($data[]) a variables normales 
// para escribirlas con más facilidad
$incidencia = $data['incidencia'];

echo "<h1>Modificación de incidencias </h1>";


// Creamos el formulario con los campos del libro
// y lo rellenamos con los datos que hemos recuperado de la BD
echo '<form action="index.php" method="get" >
        <input type="hidden" name="id" value="'.$incidencia->id.'">
        <input type="hidden" name="action" value="modificarIncidencias">
        Fecha Alta: <br><input type="date" name="fecha_alta" value="'.$incidencia->fecha_alta.'"><br>
        Lugar: <br><input type="text" name="lugar" value="'.$incidencia->lugar.'"><br>
        Equipo afectado: <br><input type="text" name="equipo_afectado" value="'.$incidencia->equipo_afectado.'"><br>
        Descripción: <br><textarea name="descripcion">'.$incidencia->descripcion.'</textarea><br>
        Observaciones: <br><textarea name="observaciones">'.$incidencia->observaciones.'</textarea><br>
        <input type="hidden" name="usuario_creador" value="'.$incidencia->usuario_creador.'">
        Estado: <br><select name="estado" size="3" style="width:100px">';
                
                    //Listado de los tipos de estados de las incidencias:
                        if ($incidencia->estado == 'abierto') {
                            echo '<option value="abierto" selected>Abierto</option>';
                        }else {
                            echo '<option value="abierto">Abierto</option>';
                        }if ($incidencia->estado == 'en espera') {
                            echo '<option value="en espera" selected>En espera</option>';
                        }else {
                            echo '<option value="en espera">En espera</option>';
                        }if ($incidencia->estado == 'cerrado') {
                            echo '<option value="cerrado" selected>Cerrado</option>';
                        }else {
                            echo '<option value="cerrado">Cerrado</option>';
                        }
                           echo '</select><br>';

        // Comprobaremos el estado de la sesion del usuario para comprobar si es admin o no para 
        // poder mostrarle la prioridad de los distintos tipos de prioridad


        if ($_SESSION['tipo'] == 0) {
            echo 'Prioridad: <br><select name="prioridad">';
            if ($incidencia->prioridad == 'alta') {
                echo '<option value="alta" selected>Alta</option>';
            } else {
                echo '<option value="alta">Alta</option>';
            } if ($incidencia->prioridad == 'media') {
                echo '<option value="media" selected>Media</option>';
            }else{
                echo '<option value="media">Media</option>';}
            if ($incidencia->prioridad == 'baja') {
            echo '<option value="baja" selected>Baja</option>';
            }else{
                echo '<option value="baja">Baja</option>';
            }
                        
            echo '</select>';
        }
        
// Finalizamos el formulario
                echo '<br><br>';
                echo '<input type="submit" value="Modificar incidencia">
               </form>';
?>