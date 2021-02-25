<?php

class UsuariosController extends Controller{
	public function index(){
		$conn = new Conexion();
		
		global $conexion;
		global $arrayUsuarios;
		
		$filtro = (isset($_POST['listado_busqueda'])) ? $_POST['listado_busqueda'] : '';
		$pagina = (isset($_POST['listado_pagina'])) ? $_POST['listado_pagina'] : 0;
		
		
		$listado = $this->model('Usuarios');
		$usuarios = $listado->getListado($filtro, $pagina);
		
		$paginado = ceil($usuarios['totalRows']['total'] / RESULTADOSXPAGINA);
		
		$this->vista('usuarios/index', [
			'root_assets' => $this->rootAssets(),
			'usuarios' => $usuarios['listado'],
			'paginado' => $paginado,
			'pagina' => $pagina,
			'busqueda' => $filtro,
			'session' => $_SESSION
		]);		
	}
	
	public function eliminar(){
		$ID = (isset($_POST['ID'])) ? $_POST['ID'] : 0;
		
		$return['error'] = 1;
		$return['mensaje'] = 'Usuario inválido. No se pudo eliminar';
		
		if($ID != 0){
			$usuario = $this->model('Usuarios');
			$eliminar = $usuario->eliminar($ID);
			$return['error'] = 0;
			$return['mensaje'] = 'El usuario se eliminó correctamente.';
		}

		echo json_encode($return);
	}
	
	public function nuevo(){
		
		$mensaje = ['error' => 0, 'mensaje' => ''];
		
		if(isset($_POST['id'])){
			$datos = Array();
			$datos['id'] = (isset($_POST['id'])) ? $_POST['id'] : 0;
			$datos['nombre'] = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
			$datos['apellido'] = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
			$datos['mail'] = (isset($_POST['mail'])) ? $_POST['mail'] : '';
			$datos['telefono'] = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
			$datos['clave'] = (isset($_POST['clave'])) ? $_POST['clave'] : '';
			$datos['clave2'] = (isset($_POST['clave2'])) ? $_POST['clave2'] : '';
			
			$mensaje = $this->guardarUsuario($datos);
			
			if($mensaje['error'] == 0){
				header('location:'.$this->rootAssets().'usuarios/modificar/'.$mensaje['id'].'/1');
			}
		}
		
		$this->vista('usuarios/nuevo', [
			'root_assets' => $this->rootAssets(),
			'session' => $_SESSION,
			'mensaje' => $mensaje
		]);	
	}
	
	public function modificar($ID, $nuevo = 0){
		
		$nuevoUsuario = ($nuevo == 1) ? 'El usuario se creó correctamente.' : '';
		$mensaje = ['error' => 0, 'mensaje' => $nuevoUsuario];
		
		if(isset($_POST['id'])){
			$datos = Array();
			$datos['id'] = (isset($_POST['id'])) ? $_POST['id'] : 0;
			$datos['nombre'] = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
			$datos['apellido'] = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
			$datos['mail'] = (isset($_POST['mail'])) ? $_POST['mail'] : '';
			$datos['telefono'] = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
			$datos['clave'] = (isset($_POST['clave'])) ? $_POST['clave'] : '';
			$datos['clave2'] = (isset($_POST['clave2'])) ? $_POST['clave2'] : '';
			
			$mensaje = $this->guardarUsuario($datos);
		}
		
		
		$usuario = $this->model('Usuarios');
		
		$this->vista('usuarios/modificar', [
			'root_assets' => $this->rootAssets(),
			'session' => $_SESSION,
			'mensaje' => $mensaje,
			'datos' => $usuario->findById($ID)
		]);	
	}
	
	public function guardarUsuario($datos){
		$return = ['error' => 0, 'mensaje' => 'El usuario se guardó correctamente.', 'id' => 0];
		
		if($datos['nombre'] == ''){
			$return['error'] = 1;
			$return['mensaje'] = 'El campo nombre no puede estar vacío.';
			return $return;
		}
		if($datos['apellido'] == ''){
			$return['error'] = 1;
			$return['mensaje'] = 'El campo apellido no puede estar vacío.';
			return $return;
		}
		if($datos['mail'] == ''){
			$return['error'] = 1;
			$return['mensaje'] = 'El campo mail no puede estar vacío.';
			return $return;
		}
		if($datos['telefono'] == ''){
			$return['error'] = 1;
			$return['mensaje'] = 'El campo teléfono no puede estar vacío.';
			return $return;
		}
		if($datos['clave'] == '' && $datos['id'] == 0){
			$return['error'] = 1;
			$return['mensaje'] = 'Debe ingresar una contraseña para el nuevo usuario.';
			return $return;
		}
		if($datos['clave2'] == '' && $datos['clave'] != ''){
			$return['error'] = 1;
			$return['mensaje'] = 'Debe repetir la contraseña ingresada.';
			return $return;
		}
		if($datos['clave'] != $datos['clave2']){
			$return['error'] = 1;
			$return['mensaje'] = 'Las contraseñas no coinciden.';
			return $return;
		}
		
		$usuario = $this->model('Usuarios');
		$guardar = ($datos['id'] == 0) ? $usuario->guardar($datos) : $usuario->modificar($datos);;
		
		if($guardar == 0){
			$return['error'] = 1;
			$return['mensaje'] = 'Se produjo un error guardando el usuario.';
		}else{
			$return['id'] = $guardar;
		}
		return $return;
	}
}