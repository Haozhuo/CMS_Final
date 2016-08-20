<?php

//define an associative array
$db['database_host']='localhost';
$db['database_user']='root';
$db['database_password']='';
$db['database_name']='cms';

//loop through the array
foreach ($db as $key => $value) {
	define(strtoupper($key),$value);
}

//make the connection
$connection=mysqli_connect(DATABASE_HOST,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);

/*
if($connection){
	echo "connected to database";
}*/

if(!$connection){
	echo "connection error";
}

?>