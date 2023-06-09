<?php
session_start();
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
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!--Header-->
  <header class="p-3 text-bg-dark fixed-top">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        
        <li class="nav-link px-2 text-white"><h2>Home</h2></li>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          
          <li><a href="index.html" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="pages/myGroups.php" class="nav-link px-2 text-white">Ordner</a></li>
          <li><a href="pages/abfrage.php" class="nav-link px-2 text-white">Abfrage</a></li>
          <li><a href="snake/game.html" class="nav-link px-2 text-white">Break</a></li>
        </ul>

        <!--
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
              <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
            </form>
            -->


            
        <div class="text-end">
        <?php 

        
        
        if(isset($_SESSION['nutzername'])){
          print_r($_SESSION['nutzername']);
          echo' <a href="pages/auth/helper/logout.php">
          <button type="submit" class="btn btn-outline-light me-2" data-bs-dismiss="modal">logout</button>
          </a>';
          
        }else{
          print_r("Guest");
          echo' <a href="pages/auth/login.html" class="btn btn-outline-light me-2">Login</a>';
        }
        ?>
          <!--<a href="pages\auth\login.html" class="btn btn-outline-light me-2">Login</a>-->
          <a href="pages/auth/signup.html" class="btn btn-warning">Sign-up</a>
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

  <!--Design front Page-->
  <div id="frontContainer">
    <h1>Level up your Skills!</h1>
    <p>This is the perfect platform to learn your Vocabs in a structured manner.</p>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>
