<?php
define("HOST", "localhost"); // The host you want to connect to.
define("USER", "1_fusion"); // The database username.
define("PASSWORD", "Ivhgsvvusdmtwdo0"); // The database password.
define("DATABASE", "1_hsh"); // The database name.
 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
$mysqli->set_charset("utf8");

//$spojeni=mysql_connect(HOST,USER,PASSWORD) or die ('Verbindung schlug fehl');
//mysql_select_db(DATABASE, $spojeni);
//mysql_query("Set names 'utf8'");