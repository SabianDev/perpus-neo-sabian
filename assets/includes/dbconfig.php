<?php
//db configuration
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "db_progweb_perpus";

//create connection to db
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

//check connection
if ($db->connect_error) {
	die("Connection failed: ".$db->connect_error);
}

?>