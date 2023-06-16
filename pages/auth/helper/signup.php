<?php
$nutzername = $_POST['nutzername'];
$passwort = $_POST['passwort'];

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

$sql = "SELECT * from User where username = $name"; 
$result = $conn->query($sql); 

//check if username not taken
if($result-> num_rows <= 0){
    //not taken

    //create account
    $sql = "INSERT INTO User (nutzername, passwort) VALUES ($nutzername, $passwort)"; 
    if ($conn->query($sql) === TRUE) { 
        echo "New record created successfully"; 
    } else { 
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    //login
    session_start();
    $_SESSION['nutzername'] = $nutzername;
    header('LOCATION ../../index.html');

}else{
    //username already exists
    echo "Dieser Nutzername ist nicht verfügbar."
} 

$conn->close(); 


header('LOCATION ../../index.html');
exit();
?> 

