<?php	
	
	class Conexion {
		
		public function conectar(){
			
			global $conexion;
			
			$conexion = mysqli_connect(HOSTDB, USERDB, PASSDB, DB);
		}
		
		public function cerrar(){
			
			global $conexion;
			
			mysqli_close($conexion); 
		}
	}