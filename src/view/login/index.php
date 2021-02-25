<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Prueba Técnica Stampymail</title>
		<link rel="stylesheet" href='<?=$params['root_assets']?>css/estilos.css' />
		<script src="<?=$params['root_assets']?>js/oGen.js"></script>
	</head>
	<body>
		<div class='lineaTop'></div>
		
		<div class='contenedor contLogin'>
			<h1>Login</h1>
			<div class='contInput'>
				<input type='text' name='login_mail' id='login_mail' placeholder='ej: admin@admin.com' autocomplete='off' value="" />
				<label class='labelErrores' id='login_mail_error'></label>
			</div>
			<div class='contInput'>
				<input type='password' name='login_pass' id='login_pass' placeholder='ej: admin' autocomplete='new-password' />
				<label class='labelErrores' id='login_pass_error'></label>
			</div>
			<div class='contInput'>
				<button id='ingresar' class='btnVerde'>Ingresar</button>
			</div>
		</div>
		
		
		<div class='lineaBottom'></div>
		
		<script>
			document.getElementById("ingresar").addEventListener("click", oGen.login);
		</script>
	</body>
</html>