<?php
$name = $_POST['name'];
$oid = $_POST['oid'];
$privat = $_POST['privat'];

$servername = "localhost"; 
$username = "vokabeln"; 
$password = "Q1ShlM_vokablen"; 
$dbname = "vokablen"; 

// Create connection 
$conn = new mysqli($servername, $username, $password, $dbname); 
// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 

//create Ordner in Database mit name und private

$sql = "insert into Ordner(name, privat) values('.$name', '.$privat)"; 
$conn->query($sql);
$oid = $conn->insert_id;

$sql = "insert into nutzt(nutzernname, oid) values('.$_SESSION['nutzername']' '.$oid')"; 
$conn->query($sql);

$conn->close(); 
exit();
?> 
