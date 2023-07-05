<?php
$sprache1 = $_POST['sprache'][0];
$sprache2 = $_POST['sprache'][1];
$wort1 = $_POST['wort1'];
$wort2 = $_POST['wort2'];
$schwierigkeit = $_POST['schwierigkeit'];
$tipp = $_POST['tipp'];


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

//create Word in Database

$sql = "insert into Vokabel(textv, Bezeichnung) values('.$wort1', '.$sprache1')"; 
$conn->query($sql);

$sql = "insert into Vokabel(textv, Bezeichnung) values('.$wort2', '.$sprache2')"; 
$conn->query($sql);

$sql = "insert into Paar(tipp, schwierigkeit) values('.$tipp', '.$schwierigkeit')"; 
$conn->query($sql);
$pnr = $conn->insert_id;

$sql = "insert into besitzt(pnr, textv, bezeichnung) values('.$pnr' '.$wort1', '.$sprache1')"; 
$conn->query($sql);

$sql = "insert into besitzt(pnr, textv, bezeichnung) values('.$pnr '.$wort2', '.$sprache2')"; 
$conn->query($sql);



$conn->close(); 
exit();
?> 
