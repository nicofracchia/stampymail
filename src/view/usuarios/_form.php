<?php
	$id = (isset($params['datos']['id'])) ? $params['datos']['id'] : 0;
	$nombre = (isset($params['datos']['nombre'])) ? $params['datos']['nombre'] : '';
	$apellido = (isset($params['datos']['apellido'])) ? $params['datos']['apellido'] : '';
	$mail = (isset($params['datos']['mail'])) ? $params['datos']['mail'] : '';
	$telefono = (isset($params['datos']['telefono'])) ? $params['datos']['telefono'] : '';
?>

<form action='#' method='post' id='abm_usuarios'>
	<input type='hidden' name='id' id='id' value="<?=$id?>" />
	<div class='campo'>
		<label for='nombre'>Nombre</label>
		<input type='text' name='nombre' id='nombre' value="<?=$nombre?>" />
		<label class='labelErrores' id='abm_nombre_error'></label>
	</div>
	<div class='campo'>
		<label for='apellido'>Apellido</label>
		<input type='text' name='apellido' id='apellido' value="<?=$apellido?>" />
		<label class='labelErrores' id='abm_apellido_error'></label>
	</div>
	<div class='campo'>
		<label for='mail'>Mail</label>
		<input type='text' name='mail' id='mail' value="<?=$mail?>" />
		<label class='labelErrores' id='abm_mail_error'></label>
	</div>
	<div class='campo'>
		<label for='telefono'>Teléfono</label>
		<input type='text' name='telefono' id='telefono' value="<?=$telefono?>" />
		<label class='labelErrores' id='abm_telefono_error'></label>
	</div>
	<div class='campo'>
		<label for='clave'>Nueva contraseña</label>
		<input type='password' name='clave' id='clave' autocomplete='new-password' />
		<label class='labelErrores' id='abm_clave_error'></label>
	</div>
	<div class='campo'>
		<label for='clave2'>Repetir contraseña</label>
		<input type='password' name='clave2' id='clave2' autocomplete='new-password' />
		<label class='labelErrores' id='abm_clave2_error'></label>
	</div>
	<div class='campo botones'>
		<button class='btnVerde'>Guardar</button>
		<a href='<?=$params['root_assets']?>usuarios/listado' class='btnBlanco'>Cancelar</a>
	</div>
</form>

<script>
	//document.getElementById('abm_usuarios').addEventListener('submit', oGen.fnValidaABM);
	document.getElementById('abm_usuarios').addEventListener("submit", function(e) {
        e.preventDefault();
        oGen.fnValidaABM();
    }, true);
</script>