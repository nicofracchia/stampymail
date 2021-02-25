var oGen = oGen || {};

// LOGIN
oGen.fnCierraLabelsErrores = function(){
	document.querySelectorAll('.labelErrores').forEach(
		function(item, index){
			item.style.display='none';
			item.innerHTML = '';
		}
	);
};

oGen.login = function () {
	let usuario = document.getElementById('login_mail').value;
	let pass = document.getElementById('login_pass').value;
	
	oGen.fnCierraLabelsErrores();
	
	if(usuario == ''){
		document.getElementById('login_mail_error').innerHTML = ' * Debe ingresar su mail.';
		document.getElementById('login_mail_error').style.display = 'block';
		document.getElementById('login_mail').focus();
		return false;
	}
	if(pass == ''){
		document.getElementById('login_pass_error').innerHTML = ' * Debe ingresar su contraseña.';
		document.getElementById('login_pass_error').style.display = 'block';
		document.getElementById('login_pass').focus();
		return false;
	}
	
	let formData = new FormData();
        formData.append("usuario", usuario);
        formData.append("pass", pass);
		
	fetch('login/validaLogin', {
        method: 'post',
        mode: 'cors',
        credentials: 'same-origin',
        body: formData
    }).then(function(response){
        return response.json();
    }).then(function(json){
        if(json.error_usuario != ''){
			document.getElementById('login_mail_error').innerHTML = json.error_usuario;
			document.getElementById('login_mail_error').style.display = 'block';
			document.getElementById('login_mail').focus();
			return false;
		}
		if(json.error_pass != ''){
			document.getElementById('login_pass_error').innerHTML = json.error_pass;
			document.getElementById('login_pass_error').style.display = 'block';
			document.getElementById('login_pass').focus();
			return false;
		}
		window.location.href = window.location.href+'usuarios';
    }).catch(function(error){
        console.log('ERROR:', error);
    })
};


// LISTADO DE USUARIOS
oGen.paginado = function(){
	let pagina = parseInt(this.dataset.numero);
	document.getElementById('listado_pagina').value = pagina;
	document.getElementById('listado_busqueda').value = document.getElementById('listado_busqueda_anterior').value;
	document.getElementById('frmFiltros').submit();
}

oGen.filtroLitado = function(){
	document.getElementById('listado_pagina').value = 0;
}


// ACCIONES
oGen.eliminarUsuario = function (){
	let root = document.getElementById('oGen').dataset.root;
	let tr = this.parentElement.parentElement;
	let nombre = tr.querySelector('.listNombre').innerHTML;
	let apellido = tr.querySelector('.listApellido').innerHTML;
	let ID = this.dataset.idusuario;
	
	if(confirm('Seguro que desea eliminar al usuario '+nombre+' '+apellido+'?')){
		let formData = new FormData();
			formData.append("ID", ID);
			
		fetch(root+'usuarios/eliminar', {
			method: 'post',
			mode: 'cors',
			credentials: 'same-origin',
			body: formData
		}).then(function(response){
			return response.json();
		}).then(function(json){
			let color = "txtRojo";
			
			if(json.error == 0){
				color = "txtVerde";
				tr.remove();
			}
			
			let mensaje = "<span class='"+color+"'>"+json.mensaje+"</span>";
			
			document.getElementById('mensajesListados').innerHTML = mensaje;
			
		}).catch(function(error){
			console.log('ERROR:', error);
		})
	}
}


// ABM
oGen.fnValidaABM = function(){
	
	oGen.fnCierraLabelsErrores();
	
	if(document.getElementById('nombre').value == ''){
		document.getElementById('abm_nombre_error').innerHTML = ' * Debe ingresar su nombre.';
		document.getElementById('abm_nombre_error').style.display = 'block';
		document.getElementById('nombre').focus();
		return false;
	}
	if(document.getElementById('apellido').value == ''){
		document.getElementById('abm_apellido_error').innerHTML = ' * Debe ingresar su apellido.';
		document.getElementById('abm_apellido_error').style.display = 'block';
		document.getElementById('apellido').focus();
		return false;
	}
	if(document.getElementById('mail').value == ''){
		document.getElementById('abm_mail_error').innerHTML = ' * Debe ingresar su mail.';
		document.getElementById('abm_mail_error').style.display = 'block';
		document.getElementById('mail').focus();
		return false;
	}
	if(document.getElementById('telefono').value == ''){
		document.getElementById('abm_telefono_error').innerHTML = ' * Debe ingresar su teléfono.';
		document.getElementById('abm_telefono_error').style.display = 'block';
		document.getElementById('telefono').focus();
		return false;
	}
	if(document.getElementById('clave').value == '' && document.getElementById('id').value == 0){
		document.getElementById('abm_clave_error').innerHTML = ' * Debe ingresar la contraseña.';
		document.getElementById('abm_clave_error').style.display = 'block';
		document.getElementById('clave').focus();
		return false;
	}
	if(document.getElementById('clave2').value == '' && document.getElementById('clave').value != ''){
		document.getElementById('abm_clave2_error').innerHTML = ' * Debe repetir la contraseña.';
		document.getElementById('abm_clave2_error').style.display = 'block';
		document.getElementById('clave2').focus();
		return false;
	}
	if(document.getElementById('clave').value != document.getElementById('clave2').value){
		document.getElementById('abm_clave2_error').innerHTML = ' * Las contraseñas no coinciden.';
		document.getElementById('abm_clave2_error').style.display = 'block';
		document.getElementById('clave2').focus();
		return false;
	}
	
	document.getElementById('abm_usuarios').submit();
	
}