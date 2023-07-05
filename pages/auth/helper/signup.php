<?php
$nutzername = $_POST['nutzername'];
$passwort = $_POST['passwort'];
$passwortRepeat = $_POST['passwortRepeat'];

$servername = "localhost"; 
$username = "vokabeln"; 
$password = "Q1ShlM_vokablen"; 
$dbname = "vokabeln"; 


// Create connection 
$conn = new mysqli($servername, $username, $password, $dbname); 
// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 

$sql = "SELECT * from User where nutzername = '".$nutzername."'"; 
$result = $conn->query($sql); 

//check if username not taken
if($result-> num_rows <= 0){
    //not taken

    //create account
    $passwort = password_hash($passwort, PASSWORD_DEFAULT);
    $sql = "INSERT INTO User (nutzername, passwort) VALUES ('".$nutzername."', '".$passwort."')"; 
    $conn->query($sql);
    $conn->close(); 

    //login
    session_start();
    $_SESSION['nutzername'] = $nutzername;
    header('Location: ../../../index.php?succsess=1');
    exit();
}else{
    $conn->close(); 
    //username already exists
    header('Location: ../signup.html');
    //echo '"Dieser Nutzername ist nicht verfügbar."';
    exit();
} 