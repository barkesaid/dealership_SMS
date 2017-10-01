<?php 
//theUssdDb.php
//Connection Credentials
$servername = 'localhost';
$username = 'barke';
$password = "";
$database = "kenyamotors";
$dbport = 3306;

session_start();
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        header('Content-type: text/plain');
        //log error to file/db $e-getMessage()
        die("END An error was encountered. Please try again later");
    } 

    echo "Connected successfully (".$conn->host_info.")";



?>