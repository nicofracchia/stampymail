<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Prueba Técnica Stampymail</title>
		<link rel="stylesheet" href='<?=$params['root_assets']?>css/estilos.css' />
		<script src="<?=$params['root_assets']?>js/oGen.js"></script>
	</head>
	<body>
		<div class='lineaTop'>
			<span class='nyaTop'>Bienvenido <?=$params['session']['nombre']?> <?=$params['session']['apellido']?></span>
			<a href='<?=$params['root_assets']?>cerrarsesion'>Cerrar sesión</a>
		</div>
		
		<h1>Nuevo usuario</h1>
		
		<?php
			if($params['mensaje']['mensaje'] != ''){
				$color = ($params['mensaje']['error'] == 1) ? 'txtRojo' : 'txtVerde';
				echo "<div id='mensajesListados'><span class='".$color."'>".$params['mensaje']['mensaje']."</span></div>";
			}
		?>
		
		<div class='contenedor contFrmUsuario'>
			<?php require_once '_form.php'; ?>
		</div>
		
		<div class='lineaBottom'></div>
		
	</body>
</html>