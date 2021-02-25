<?php
	//print_r($params['session']);
	//exit();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Prueba Técnica Stampymail</title>
		<link rel="stylesheet" href='<?=$params['root_assets']?>css/estilos.css' />
		<script src="<?=$params['root_assets']?>js/oGen.js" id='oGen' data-root="<?=$params['root_assets']?>"></script>
	</head>
	<body>
		<div class='lineaTop'>
			<span class='nyaTop'>Bienvenido <?=$params['session']['nombre']?> <?=$params['session']['apellido']?></span>
			<a href='<?=$params['root_assets']?>cerrarsesion'>Cerrar sesión</a>
		</div>
		
		<h1>Listado de usuarios</h1>
		
		<div class='contenedor contNuevoUsuario'>
			<a href='<?=$params['root_assets']?>usuarios/nuevo'>Crear nuevo usuario</a>
			<form action='' method='post' id='frmFiltros'>
				<input type='hidden' name='listado_pagina' id='listado_pagina' value='<?=$params['pagina']?>' />
				<input type='hidden' name='listado_busqueda_anterior' id='listado_busqueda_anterior' value='<?=$params['busqueda']?>' />
				<input type='text' name='listado_busqueda' id='listado_busqueda' placeholder='Busqueda...' value='<?=$params['busqueda']?>' />
				<button id='listado_ingresar' class='btnVerde'>Buscar</button>			
			</form>
		</div>
		
		<div id='mensajesListados'></div>
		
		<div class='contenedor contListado'>
			<table>
				<tr>
					<th class='listNombre'>Nombre</th>
					<th class='listApellido'>Apellido</th>
					<th class='listMail'>Mail</th>
					<th class='listAcciones'>Acciones</th>
				</tr>
				<?php
					if(!is_array($params['usuarios']) or count($params['usuarios']) == 0){
						echo "<tr><td colspan=5>No se encontraron resultados para esta búsqueda.</td></tr>";
					}else{
						foreach($params['usuarios'] as $u){
							echo "<tr>";
							echo "	<td class='listNombre'>".$u['nombre']."</td>";
							echo "	<td class='listApellido'>".$u['apellido']."</td>";
							echo "	<td class='listMail'>".$u['mail']."</td>";
							echo "	<td class='listAcciones'>";
							echo "		<a href='".$params['root_assets']."usuarios/modificar/".$u['id']."'>";
							echo "			<img src='".$params['root_assets']."images/editar.svg' alt='Editar usuario' title='Editar usuario' />";
							echo "		</a>";
							echo "		<img class='eliminar' src='".$params['root_assets']."images/eliminar.svg' alt='Eliminar usuario' title='Eliminar usuario' data-idusuario='".$u['id']."' />";
							echo "	</td>";
							echo "</tr>";
						}						
					}
				?>
				<tr>
					<td colspan='4' class='paginado'>
						<?php
							for($i = 0; $i < $params['paginado']; $i++){
								$sel = ($i == $params['pagina']) ? "class='seleccionado'" : "";
								
								echo "<span ".$sel." data-numero='".$i."'>".($i+1)."</span>";
							}
						?>
					</td>
				</tr>
			</table>
		</div>
		
		<div class='lineaBottom'></div>
		
		<script>
			// FILTROS
			document.getElementById('frmFiltros').addEventListener("submit", oGen.filtroLitado);
			document.querySelectorAll('.paginado span').forEach(function(item, index){
				item.addEventListener("click", oGen.paginado);
			});
			
			// ACCIONES
			document.querySelectorAll('.eliminar').forEach(function(item, index){
				item.addEventListener("click", oGen.eliminarUsuario);
			});
		</script>
	</body>
</html>