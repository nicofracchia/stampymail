# stampymail
<b>Prueba Técnica StampyMail</b>


Hay que poner la ruta que corresponda en el archivo <b>public/.htaccess</b> para que funcionen las rutas.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&middot; Línea 4: RewriteBase /stampymail/public
<br><br>
Los datos de conexión a la base de datos se modifican en las constantes del archivo <b>src/init.php</b> (También se puede modificar el valor de la contante "RESULTADOSXPAGINA" para cambiar la cantidad de resultados que muestra el listado de usuarios.<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&middot; Línea 4: define('HOSTDB', 'localhost');<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&middot; Línea 5: define('USERDB', 'root');<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&middot; Línea 6: define('PASSDB', '');<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&middot; Línea 7: define('DB', 'stampymail');<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&middot; Línea 10: define('RESULTADOSXPAGINA', 5);<br>
<br><br>
Se incluye el archivo <b>usuarios.sql</b> para crear la tabla con los campos necesarios, incluye la inserción de un usuario para poder loguearse en el sistema con estas credenciales:<br>
      <b>Usuario:</b> admin@admin.com<br>
      <b>Password:</b> 123<br>
<br><br>
Todo el desarrollo fue hecho desde cero con patron MVC y sin librerias ni frameworks.
