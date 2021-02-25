<?php

class Controller{
	
	protected $model;
	
	public function model($model){
		
		$model = ucfirst($model);
		
		$this->modelExistsCI($model);
		
		require_once '../src/model/'.$this->model;
		
		return new $model();
		
	}
	
	public function modelExistsCI($model){
		$nombre = ucfirst($model).'.php';
		$archivo = '../src/model/'.$nombre;
		
		if(file_exists($archivo)){
			$this->model = $nombre;
		}else{
			$carpeta = dirname($archivo);
			$archivosArray = glob($carpeta.'/*', GLOB_NOSORT);
			$archivoLC = strtolower($archivo);
			foreach($archivosArray as $a){
				if(strtolower($a) == $archivoLC){
					$this->model = basename($a);
				}
			}
		}
	}
	
	public function vista($vista, $params = []){
		require_once '../src/view/'.$vista.'.php';
	}
	
	public function rootAssets(){
		$carpeta = '';
		if(isset($_GET['url'])){
			$url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
			$carpeta = '';
			for($i = 1; $i < count($url); $i++){
				$carpeta .= '../';
			}
		}
		return $carpeta;
	}
	
}