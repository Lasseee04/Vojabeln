<?php
$sprache1 = $_POST['Sprache'][0];
$sprache2 = $_POST['Sprache'][1];
$wort1 = $_POST['wort1'];
$wort2 = $_POST['wort2'];
$schwierigkeit = $_POST['schwierigkeit'];


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


//Vokabel 1
$sql = "inset into Vokabel(textv, Bezeichnung) values(..., '.$wort1', '.$sprache1')"; 
$conn->query($sql);

//Vokabel 2
$sql = "inset into besitzt(pnr, textv, bezeichnung) values(..., '.$wort2', '.$sprache2')"; 
$conn->query($sql);

$newPnr
$sql = "inset into Paar(tipp, schwierigkeit) values(..., ..., '.$schwierigkeit')"; 
$conn->query($sql);

if ($result->num_rows > 0) { 
    //output data of each row 
    $user = $result->fetch_assoc();
            //nutzer existiert
            if(password_verify($passwort, $user["passwort"])){
                //passwort für diesen Nuter stimmt
                //anmelden
                session_start();
                $_SESSION['nutzername'] = $nutzername;
                header('LOCATION ../../index.html');
            }else{
                echo "Das Passwort ist falsch";
            }
}else{
    echo "Der Nutzername existiert nicht";
}

$conn->close(); 
exit();
?> 
