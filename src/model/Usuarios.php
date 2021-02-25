<?php

class Usuarios{
	
	public function findByMail($usuario){
		
		global $conexion;
		
		$conn = new Conexion();
		
		$conn::conectar();
		
		$SQL = "SELECT * FROM usuarios WHERE mail = ?";
		$STMT = mysqli_prepare($conexion, $SQL);
		$STMT->bind_param('s', $usuario);
		$STMT->execute();
		$RS = $STMT->get_result();
		$STMT->fetch();
		$STMT->close();		
		
		$conn::cerrar();
		
		return mysqli_fetch_array($RS, MYSQLI_ASSOC);
	}
	
	public function findById($ID){
		
		global $conexion;
		
		$conn = new Conexion();
		
		$conn::conectar();
		
		$SQL = "SELECT * FROM usuarios WHERE id = ?";
		$STMT = mysqli_prepare($conexion, $SQL);
		$STMT->bind_param('i', $ID);
		$STMT->execute();
		$RS = $STMT->get_result();
		$STMT->fetch();
		$STMT->close();	
		
		$conn::cerrar();
		
		return mysqli_fetch_array($RS, MYSQLI_ASSOC);
	}
	
	public function getListado($busqueda = '', $pagina = 0){
		global $conexion;
		
		$return = Array();
		
		$conn = new Conexion();
		
		$conn::conectar();
		
		$where = '';
		if($busqueda != ''){
			$where = " WHERE nombre LIKE ? OR  apellido LIKE ? OR  mail LIKE ? OR  telefono LIKE ? ";
		}
		// LISTADO
		$SQL = "SELECT * FROM usuarios ";
		$SQL .= $where;
		$SQL .= "ORDER BY apellido ASC, nombre ASC ";
		$SQL .= "LIMIT ?, ".RESULTADOSXPAGINA;
		
		$STMT = mysqli_prepare($conexion, $SQL);
		$limitFrom = $pagina * RESULTADOSXPAGINA;
		if($busqueda == ''){
			$STMT->bind_param('i', $limitFrom);
		}else{
			$params = Array('%'.$busqueda.'%', '%'.$busqueda.'%', '%'.$busqueda.'%', '%'.$busqueda.'%', $limitFrom);
			$STMT->bind_param('ssssi', ...$params);
		}
		$STMT->execute();
		$RS = $STMT->get_result();
		$STMT->fetch();
		$STMT->close();	
		
		// TOTAL PARA PAGINADO
		$SQL_TOTAL = "SELECT COUNT(*) AS total FROM usuarios ".$where;
		
		$STMT = mysqli_prepare($conexion, $SQL_TOTAL);
		if($busqueda != ''){
			$params = Array('%'.$busqueda.'%', '%'.$busqueda.'%', '%'.$busqueda.'%', '%'.$busqueda.'%');
			$STMT->bind_param('ssss', ...$params);
		}
		$STMT->execute();
		$RS_TOTAL = $STMT->get_result();
		$STMT->fetch();
		$STMT->close();	
		
		
		$conn::cerrar();
		
		$return['listado'] = mysqli_fetch_all($RS, MYSQLI_ASSOC);
		$return['totalRows'] = mysqli_fetch_array($RS_TOTAL, MYSQLI_ASSOC);
		
		return $return;
		
	}
	
	public function eliminar($ID = 0){
		global $conexion;
		
		$return = Array();
		
		$conn = new Conexion();
		
		$conn::conectar();
		
		/*
		$SQL = "DELETE FROM usuarios WHERE id = ".$ID;
		$RS = mysqli_query($conexion, $SQL);
		*/
		
		$SQL = "DELETE FROM usuarios WHERE id = ?";
		$STMT = mysqli_prepare($conexion, $SQL);
		$STMT->bind_param('i', $ID);
		$STMT->execute();
		$RS = $STMT->get_result();
		$STMT->fetch();
		$STMT->close();
		
		$conn::cerrar();
	}
	
	public function guardar($datos){
		global $conexion;
		
		$return = Array();
		
		$conn = new Conexion();
		
		$conn::conectar();
		
		$SQL = "INSERT INTO usuarios (nombre, apellido, mail, telefono, clave) VALUES (?, ?, ?, ?, ?)";
		$params = Array($datos['nombre'], $datos['apellido'], $datos['mail'], $datos['telefono'], password_hash($datos['clave'], PASSWORD_DEFAULT));
		$STMT = mysqli_prepare($conexion, $SQL);
		$STMT->bind_param('sssss', ...$params);
		
		if(mysqli_stmt_execute($STMT)){
			$SQL_ID = "SELECT LAST_INSERT_ID() AS LID";
			$RS_ID = mysqli_query($conexion, $SQL_ID);
			$ID = mysqli_fetch_array($RS_ID, MYSQLI_ASSOC);
			$ID = $ID['LID'];
		}else{
			$ID = 0;
		}
		$STMT->close();	
		
		$conn::cerrar();
		
		return $ID;
	}
	
	public function modificar($datos){
		global $conexion;
		
		$return = Array();
		
		$conn = new Conexion();
		
		$conn::conectar();
		
		$SQL  = "UPDATE usuarios SET ";
		$SQL .= ($datos['clave'] != '') ? " clave = ?, " : '';
		$SQL .= " nombre = ?, apellido = ?, mail = ?, telefono = ? ";
		$SQL .= " WHERE id = ?";
		if($datos['clave'] != ''){
			$tiposDato = 'sssssi';
			$params = Array(password_hash($datos['clave'], PASSWORD_DEFAULT), $datos['nombre'], $datos['apellido'], $datos['mail'], $datos['telefono'], $datos['id']);
		}else{
			$tiposDato = 'ssssi';
			$params = Array($datos['nombre'], $datos['apellido'], $datos['mail'], $datos['telefono'], $datos['id']);
		}
		$STMT = mysqli_prepare($conexion, $SQL);
		$STMT->bind_param($tiposDato, ...$params);
		
		if(mysqli_stmt_execute($STMT)){
			$ID = $datos['id'];
		}else{
			$ID = 0;
		}
		$STMT->close();	
		
		$conn::cerrar();
		
		return $ID;
	}
}