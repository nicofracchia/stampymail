<?php

class App {
	
	protected $controller = 'LoginController.php';
	
	protected $metodo = 'index';
	
	protected $params = [];
	
	public function __construct(){
		$url = $this->parseUrl();
		
		$this->validarSesion($url);
		
		if(is_array($url)){
			$this->fileExistsCI($url[0]);
			unset($url[0]);
		}
		
		require_once '../src/controller/'.$this->controller;
		
		$clase = str_replace('.php', '', $this->controller);
				
		$this->controller = new $clase;
		
		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){
				$this->metodo = $url[1];
				unset($url[1]);
			}
		}
		
		$this->params = ($url) ? array_values($url) : [];
		
		call_user_func_array([$this->controller, $this->metodo], $this->params);
	}
	
	public function parseUrl(){
		if(isset($_GET['url'])){
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
	
	public function fileExistsCI($controller){
		$nombre = ucfirst($controller).'Controller.php';
		$archivo = '../src/controller/'.$nombre;
		
		if(file_exists($archivo)){
			$this->controller = $nombre;
		}else{
			$carpeta = dirname($archivo);
			$archivosArray = glob($carpeta.'/*', GLOB_NOSORT);
			$archivoLC = strtolower($archivo);
			foreach($archivosArray as $a){
				if(strtolower($a) == $archivoLC){
					$this->controller = basename($a);
				}
			}
		}
	}
	
	public function validarSesion($url){
		$seccionesHabilitadas = Array('','login');
		
		$url = ($url === null) ? 'login' : $url[0];
		
		if($url == 'cerrarsesion'){
			unset($_SESSION['id']);
			session_destroy();
		}
		
		if(!isset($_SESSION['id']) && !in_array($url, $seccionesHabilitadas)){
			$redirect = explode($url, $_SERVER['REQUEST_URI']);
			header('location:'.$redirect[0]);
		}
	}
}