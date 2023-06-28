<?php 

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

$nutzername = "Lucas";

$gehoert_zu_rows = $conn->query('SELECT * FROM nutzt where nutzername = "'.$nutzername.'"');
$oids = [];

if ($gehoert_zu_rows->num_rows > 0) { 
  while($gehoert_zu = $gehoert_zu_rows->fetch_assoc()) {
    $oids[] = $gehoert_zu['oid'];
  }

  $sql = "SELECT * FROM Ordner WHERE oid IN('".implode("','",$oids)."')"; 
  $result = $conn->query($sql); 
}
?> 


<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <!--Header-->
  <header class="p-3 text-bg-dark fixed-top">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <li class="nav-link px-2 text-white"><h2>Abfrage</h2></li>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="../index.html" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="myGroups.html" class="nav-link px-2 text-white">Ordner</a></li>
          <li><a href="abfrage.html" class="nav-link px-2 text-white">Abfrage</a></li>
        </ul>
        
        <div class="text-end">
          <a href="auth\login.html" class="btn btn-outline-light me-2">Login</a>
          <a href="auth\signup.html" class="btn btn-warning">Sign-up</a>
        </div>
      </div>
    </div>
  </header>

  <!--Header Placeholder--> 
  <header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap"></use>
          </svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.html" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="pages/myGroups.html" class="nav-link px-2 text-white">Ordner</a></li>
          <li><a href="pages/abfrage.html" class="nav-link px-2 text-white">Abfrage</a></li>
        </ul>

        <div class="text-end">
          <a href="pages\auth\login.html" class="btn btn-outline-light me-2">Login</a>
          <a href="pages\auth\signup.html" class="btn btn-warning">Sign-up</a>
        </div>
      </div>
    </div>
  </header>
   <!--Header Placeholde End--> 


   <!--rest design-->
  <div class="fixed-bottom buttonBar">
    <div class="text-end">
      <a href="gestartet.html" class="btn btn-outline-dark btn-warning">Start</a>
    </div>
  </div>


  <?php 

if (isset($result) && $result->num_rows > 0) {  
  // output data of each row  
  echo '<table class="table table-color table-striped table-borderless table-hover tablePosition" width="100%"> 
  <thead>  
<tr>  
<th width=2% scope="col"></th>  
<th width=30% scope="col">Name</th>  
<th width=40% scope="col">Sprachen</th>  
<th width=10% scope="col">Schwierigkeit</th>  
<th width=10% scope="col">Wörter</th>   
</tr>  
</thead>   
        <tbody>'; 
        while($row = $result->fetch_assoc()) { 
          $sql = "SELECT count('pnr') as anzahl FROM gehoert_zu where oid=$row[oid]";
          $result_anzahl = $conn->query($sql);
          $anzahl = $result_anzahl->fetch_assoc()['anzahl'];

          $sql = "SELECT avg(schwierigkeit) as schwierigkeitsschnitt FROM gehoert_zu, Paar where gehoert_zu.pnr = Paar.pnr AND oid = ".$row['oid'];
          $result_diff = $conn->query($sql);
          $schnitt = $result_diff->fetch_assoc()['schwierigkeitsschnitt'];


          $sql = "SELECT distinct sprache FROM Ordner, gehoert_zu, besitzt where Ordner.oid = gehoert_zu.oid AND gehoert_zu.pnr = besitzt.pnr";
          $result_language = $conn->query($sql); 

          $sprachen ="";

          if ($result_language->num_rows > 0) {  
            // output data of each row
            $sprachen_result = [];
            while($row_lang = $result_language->fetch_assoc()) {    
                $sprachen_result[] = $row_lang["sprache"];
            }  
            $sprachen = implode(', ', $sprachen_result);
          } 
    echo '<tr> s
              <td><input type="checkbox"></td>  
              <td><a href="myGroup.php?oid='.$row["oid"].'" style="text-decoration: none; color: inherit">'.$row["name"].'</a></td> 
              <td>'.$sprachen'</td> 
              <td>'.$schnitt'</td> 
              <td>'.$anzahl'</td>         
            </tr>'; 
          }
   
  echo ' 
  </tbody> 
  </table>'; 
} else {  
    echo "<p>Es gibt noch keinen Ordner</p>";  
}  
$conn->close();
?> 


  <!--
  <table class="table table-color table-striped table-borderless table-hover">
    <thead>
      <tr>
        <th width=2% scope="col"></th>
        <th width=33% scope="col">Name</th>
        <th width=20% scope="col">Sprache1</th>
        <th width=20% scope="col">Sprache2</th>
        <th width=15% scope="col">Schwierigkeit</th>
        <th width=10% scope="col">Wörter</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type="checkbox"></td>
        <td>Linking Words</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>7.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Globalisation</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Great Britain</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.8</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>My Son The Fanatic</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Julia</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>3.0</td>
        <td>105</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>American Dream</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Synonyme für "say"</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>2.4</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Adjectives</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.0</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Cambridge C2</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>5.0</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Shooting an Elephant</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Lasse</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>8.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Great Britain</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Linking Words</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Jacob</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Great Britain</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Linking Words</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Great Britain</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Linking Words</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>Great Britain</td>
        <td>Deutsch</td>
        <td>Englisch</td>
        <td>4.3</td>
        <td>145</td>
      </tr>
    </tbody>

  </table>
-->

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>