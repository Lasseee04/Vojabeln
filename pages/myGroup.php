<?php 

$servername = "localhost"; 
$username = "vokabeln"; 
$password = "Q1ShlM_vokablen"; 
$dbname = "vokabeln"; 

// Create connection 
$conn = new mysqli($servername, $username, $password, $dbname); 

$oid = $_GET['oid'];

// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}  

$gehoert_zu_rows = $conn->query('SELECT * FROM gehoert_zu where oid ='.$oid);
$data = [];

if ($gehoert_zu_rows->num_rows > 0) { 
  while($gehoert_zu = $gehoert_zu_rows->fetch_assoc()) {
    $pnr = $gehoert_zu['pnr'];
    $data[$pnr] = [];
    $besitzt_rows = $conn->query('SELECT * FROM besitzt WHERE pnr = '. $pnr);
    while($besitzt = $besitzt_rows->fetch_assoc()) {
      $data[$pnr][] = utf8_encode($besitzt['textv']);
    }
    $paar_rows = $conn->query('SELECT schwierigkeit FROM Paar where pnr ='.$pnr);
    $schwierigkeit = $paar_rows->fetch_assoc()['schwierigkeit'];
    $data[$pnr][] = $schwierigkeit;
  }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <!--Header-->
  <header class="p-3 text-bg-dark fixed-top">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <li class="nav-link px-2 text-white">
          <h2>Ordner</h2>
        </li>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="../index.html" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="myGroups.php" class="nav-link px-2 text-white">Ordner</a></li>
          <li><a href="abfrage.php" class="nav-link px-2 text-white">Abfrage</a></li>
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

        <!--
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
              <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
            </form>
            -->

        <div class="text-end">
          <a href="pages\auth\login.html" class="btn btn-outline-light me-2">Login</a>
          <a href="pages\auth\signup.html" class="btn btn-warning">Sign-up</a>
        </div>
      </div>
    </div>
  </header>
  <!--Header Placeholde End-->


  <div class="fixed-bottom buttonBar">
    <div class="text-end">
      <button type="button" class="btn btn-outline-dark btn-warning" data-bs-toggle="modal" data-bs-target="#erstellModal">
        Wort Erstellen
      </button>
    </div>
  </div>


  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <input name="Tipp" type="text" placeholder="Wort1"/> 
            <input name="Tipp" type="text" placeholder="Wort2"/>
            <input name="Tipp" type="number" placeholder="Schwierigkeit"/>
            <input name="Tipp" type="text" placeholder="Tipp"/>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!--Modal end-->

<!-- Erstell Modal -->
<div class="modal fade" id="erstellModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="php/wortErstellen.php" method="post">
          <select class="form-select" aria-label="Default select example" name='Sprache[]'>
            <option selected>Sprache auswählen</option>
            <?php
              $sprachen_result = $conn->query('SELECT * FROM Sprache');
              if ($sprachen_result->num_rows > 0) { 
                while($sprache = $sprachen_result->fetch_assoc()) {
                  echo '<option value="'.$sprache['Bezeichnung'].'">'.$sprache['Bezeichnung'].'</option>';
                }
              }
            ?>
          </select>
          <select class="form-select" aria-label="Default select example" name='Sprache[]'>
            <option selected>Sprache auswählen</option>
            <?php
              $sprachen_result = $conn->query('SELECT * FROM Sprache');
              if ($sprachen_result->num_rows > 0) { 
                while($sprache = $sprachen_result->fetch_assoc()) {
                  echo '<option value="'.$sprache['Bezeichnung'].'">'.$sprache['Bezeichnung'].'</option>';
                }
              }
            ?>
          </select>
          <p></p>
          <input name="wort1" type="text" placeholder="Wort1"/> 
          <input name="wort2" type="text" placeholder="Wort2"/>
          <input name="schwierigkeit" type="number" placeholder="Schwierigkeit"/>
          <input name="Tipp" type="text" placeholder="Tipp"/>
          <p></p>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--Erstell Modal end-->

<!--
  <table class="table table-color table-striped table-borderless table-hover" width="100%">
    <thead>
      <tr>
        <th width=40%  scope="col">Sprache1</th>
        <th width=40% scope="col">Sprache2</th>
        <th width=13% scope="col">Schwierigkeit</th>
        <th width=1% scope="col"></th>
        <th width=1% scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Wort1</td>
        <td>Wort2</td>
        <td>7,5</td>
        <td>
          <button type="button" class="table_btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-pencil-square"></i>
          </button>
        </td>
        <td>
          <i class="bi bi-trash"></i>
        </td>
      </tr>
      

    </tbody>

  </table>
-->

<?php
        if (count($data) > 0) { 
          // output data of each row 
          echo '<table class="table table-color table-striped table-borderless table-hover" width="100%">
         <thead>
          <tr>
            <th width = 40% scope="col">Sprache1</th>
            <th width = 40% scope="col">Sprache2</th>
            <th width = 13% scope="col">Schwierigkeit</th>
            <th width = 1% scope="col"></th>
            <th width = 1% scope="col"></th>
          </tr>
        </thead>
            <tbody>';
            foreach($data as $row) { 
              echo '<tr>
                <td>'.$row[0].'</td>
                <td>'.$row[1].'</td> 
                <td>'.$row[2].'</td>
                <td>
                <button type="button" class="table_btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-pencil-square"></i>
                </button>
                </td>
                <td>
                <button type="button" class="table_btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-trash"></i>
                </button>
                </td>
                </tr>';
            } 
            echo ' 
             </tbody>
             </table>' ;
          } else { 
            echo "Es gibt keinen Ordner" ; 
          }
          
          $conn->close();
?> 


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>
