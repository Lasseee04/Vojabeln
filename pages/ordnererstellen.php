<?php
$name = $_POST['name'];
$oid = $_POST['oid'];
$schwierigkeitsschnitt = $_POST['schwierigkeitsschnitt'];
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

//create Ordner in Database

$sql = "insert into Ordner(name, privat) values('.$name', '.$schwierigkeitsschnitt)"; 
$conn->query($sql);
$oid = $conn->insert_id;


$sql = "insert into nutzt(nutzernname, oid) values('.$nutzername' '.$wort1', '.$sprache1')"; 
$conn->query($sql);

$sql = "insert into besitzt(pnr, textv, bezeichnung) values('.$pnr '.$wort2', '.$sprache2')"; 
$conn->query($sql);



$conn->close(); 
exit();
?> 
