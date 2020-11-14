<?php
include_once("vista.php");
include_once("modelos/usuario.php");
include_once("modelos/incidencia.php");
include_once("modelos/seguridad.php");

class Controlador
{

	private $vista, $usuario, $incidencia ;

	/**
	 * Constructor. Crea las variables de los modelos y la vista
	 */
	public function __construct()
	{
		$this->vista = new Vista();
		$this->usuario = new Usuario();
		$this->incidencia = new incidencia();
		
	}

	/**
	 * Muestra el formulario de login
	 */
	/*public function formularioLogin() {
		if (!isset($_SESSION['id']))
			$this->vista->mostrar("usuario/formularioLogin");
		else
			$this->mostrarListaIncidencias();
	}*/

	public function formularioLogin(){
		$this->vista->mostrar("usuario/formularioLogin");
	}

	/**
	 * Procesa el formulario de login e inicia la sesión
	 */
	public function procesarLogin()
	{
		$correo = $_REQUEST["correo"];
		$pass = $_REQUEST["pass"];

		$result = $this->usuario->buscarUsuario($correo, $pass);

		if ($result) {
			$this->mostrarListaIncidencias();
		} else {
			// Error al iniciar la sesión
			$data['msjError'] = "Nombre de usuario o contraseña incorrectos";
			$this->vista->mostrar("usuario/formularioLogin", $data);
		}
	}

	/**
	 * Cierra la sesión
	 */
	public function cerrarSesion()
	{
		session_destroy();
		$data['msjInfo'] = "Sesión cerrada correctamente";
		$this->vista->mostrar("usuario/formularioLogin", $data);
	}

	/**
	 * Muestra una lista con todas las incidencias
	 */
	public function mostrarListaIncidencias() {
		if (isset($_SESSION['id'])) {
			if ($_SESSION['tipo'] == 0) {
				$data['listaIncidencias'] = $this->incidencia->getAll();
				
			} else if ($_SESSION['tipo'] == 1) {
				$data['listaIncidencias'] = $this->incidencia->getSelected($_SESSION['id']);
			}
			$this->vista->mostrar("incidencias/listaIncidencias", $data);
		} else {
			$data['msjError'] = 'Inicie sesion nuevamente para continuar';
			$this->vista->mostrar("usuario/formularioLogin", $data);
		}
		
	}
	/**
	 * Muestra el formulario de alta de Incidencias
	 */
	public function formularioInsertarIncidencia()
	{
		if (isset($_SESSION["id"])) {
			$this->vista->mostrar('incidencias/formularioInsertarIncidencias');
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->mostrar("usuario/formularioLogin", $data);
		}
	}

	/**
	 * Inserta un libro en la base de datos
	 */
	public function nuevaIncidencia()
	{
		
			$id= $_SESSION['id'];
			$fecha_alta = $_REQUEST["fecha_alta"];
			$lugar = $_REQUEST["lugar"];
			$equipo_afectado = $_REQUEST["equipo_afectado"];
			$descripcion = $_REQUEST["descripcion"];
			$usuario_creador = $_REQUEST["usuario_creador"];
			$observaciones = $_REQUEST["observaciones"];
			$estado = $_REQUEST["estado"];
			$prioridad = $_REQUEST["prioridad"];
			// Ahora insertamos la Incidencia en la BD

		

			$result = $this->incidencia->insert($id, $fecha_alta, $lugar, $equipo_afectado, $descripcion ,$usuario_creador ,$observaciones,$estado,$prioridad);

			if ($result == 1) {
                $data['msjInfo'] = "Incidencia creada con éxito";
            } else {
                $data['msjError'] = "Ha ocurrido un error al crear la incidencia";
            }	
			
			$data['listaIncidencias'] = $this->incidencia->getAll();
             $this->mostrarListaIncidencias();
		
	}

	/***
	 * Modificar Incidencias
	 */

	 // Formulario Modificar Incidencias
	public function formularioModificarIncidencias() {
		if (isset($_SESSION['id'])) {
			
			$id = $_REQUEST['id'];
			if ($data['incidencia'] = $this->incidencia->get($id)) {
				
				var_dump($data);
				if ($_SESSION['tipo'] == 0) {
					
					$this->vista->mostrar("incidencias/formularioModificarIncidencias",$data);
				} else {
					if ($_SESSION['id'] != $data['incidencia']->id) {
						
						$data['msjError'] = 'No tienes permisos para modificar las incidencias de otros usuarios';
					} else {
						$this->vista->mostrar("incidencias/formularioModificarIncidencias",$data);
					}
				}
			} else {
				$this->vista->mostrar("incidencias/listaIncidencias");
			}
		} 
	}

	//Modificar Incidencia 
	public function modificarIncidencias() {
		$id = $_REQUEST['id'];
		$fecha_alta = $_REQUEST['fecha_alta'];
		$lugar = $_REQUEST['lugar'];
		$equipo_afectado = $_REQUEST['equipo_afectado'];
		$descripcion = $_REQUEST['descripcion'];
		$usuario_creador = $_REQUEST['usuario_creador'];
		$observaciones = $_REQUEST['observaciones'];
		$estado = $_REQUEST['estado'];
		$prioridad = "";
		if ($_SESSION['tipo'] == 1)
			$prioridad = $_REQUEST['prioridad'];
		else
			$prioridad = 'media';

		$result = $this->incidencia->update($id,$fecha_alta,$lugar,$equipo_afectado,$descripcion, $observaciones,$estado,$prioridad);

		if ($result == 1) {
			$data['msjInfo'] = "Incidencia modificada con éxito.";
		} else {
			$data['msjError'] = "No se ha podido modificar la incidencia. Inténtelo de nuevo más tarde.";
		}
		$data['listaIncidencias'] = $this->incidencia->getAll();
		$this->vista->mostrar("incidencias/listaIncidencias",$data);
	}

	// eliminar incidencia

	public function borrarIncidencia() {
		if (isset($_SESSION['id'])) {
			if ($_SESSION['tipo'] == 0) {
				$id_incidencia = $_REQUEST['id'];
				$result = $this->incidencia->delete($id_incidencia);
				if ($result == 1)
					$data['msjInfo'] = 'Incidencia borrada con éxito';
				else
					$data['msjError'] = 'No se ha podido eliminar la incidencia. Inténtalo más tarde';
			
			$data['listaIncidencias'] = $this->incidencia->getAll();
			$this->vista->mostrar("incidencias/listaIncidencias",$data);
			} else {
				$data['msjError'] = 'No tienes permisos para realizar esa acción';
				$this->vista->mostrar("user/errorPermisos",$data);
			}
			
		} else {
			$data['msjError'] = 'Debes iniciar sesión para continuar';
			$this->vista->mostrar("user/formLogin", $data);
		}
	}
	public function buscarIncidencia() {
		$texto_busqueda = $_REQUEST['textoBusqueda'];
		$campo_filtro = $_REQUEST['campo_filtro'];
		$orden_filtro = $_REQUEST['orden_filtro'];
		$data['listaIncidencias'] = $this->incidencia->search($texto_busqueda,$campo_filtro,$orden_filtro);
		$data['msjInfo'] = 'Resultados de la búsqueda "'.$texto_busqueda.'":';
		$this->vista->mostrar("incidencias/listaIncidencias",$data);
	}
}
