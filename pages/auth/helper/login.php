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

//login

$sql = "SELECT * from User WHERE nutzername = '".$nutzername."'"; 
$result = $conn->query($sql); 


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
                echo "Das Passwort ist Falsch";
            }
}else{
    echo "Der Nutzername existiert nicht";
}

$conn->close(); 
exit();
?> 