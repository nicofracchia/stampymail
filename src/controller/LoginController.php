<?php

class LoginController extends Controller{
	public function index(){
		
		$this->vista('login/index', [
			'root_assets' => $this->rootAssets()
		]);
		
	}
	
	public function validaLogin(){
		$return['login'] = 0;
		$return['error_usuario'] = '';
		$return['error_pass'] = '';
		
		$login = $this->model('Usuarios');
		$usuario = $login->findByMail($_POST['usuario']);
		
		if($usuario === null){
			$return['error_usuario'] = '* El usuario ingresado no se encuentra registrado.';
			echo json_encode($return);
			exit();
		}
		
		if(!password_verify($_POST['pass'], $usuario['clave'])){
			$return['error_pass'] = '* Contraseña incorrecta.';
			echo json_encode($return);
			exit();
		}
		
		$this->iniciarSesion($usuario);
		
		$return['login'] = 1;
		echo json_encode($return);
	}
	
	public function iniciarSesion($usuario){
		$_SESSION['id'] = $usuario['id'];
		$_SESSION['nombre'] = $usuario['nombre'];
		$_SESSION['apellido'] = $usuario['apellido'];
	}
}