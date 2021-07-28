# Technical test


You have to put the corresponding path in the <b>public/.htaccess</b> file for the paths to work.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&middot; Line 4: RewriteBase /stampymail/public
<br><br>
The connection data to the database is modified in the constants of the file <b>src/init.php</b> (You can also modify the value of the constant "RESULTSXPAGINA" to change the amount of results that the list of users shows.).<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&middot; Line 4: define('HOSTDB', 'localhost');<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&middot; Line 5: define('USERDB', 'root');<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&middot; Line 6: define('PASSDB', '');<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&middot; Line 7: define('DB', 'stampymail');<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&middot; Line 10: define('RESULTADOSXPAGINA', 5);<br>
<br><br>
The file <b>usuarios.sql</b> is included to create the table with the necessary fields, it includes the insertion of a user to be able to log into the system with these credentials:<br>
      <b>User:</b> admin@admin.com<br>
      <b>Password:</b> 123<br>
<br><br>
All development was done from scratch with an MVC pattern and without libraries or frameworks.
