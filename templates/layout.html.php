<?php
if (isset($_SESSION['inicio']) && (time() - $_SESSION['inicio'] > 1800)) {
    
    session_unset();     
    session_destroy();   
    header('Location: /login/login');
}
$_SESSION['inicio'] = time(); // actualiza ultimo uso
?>

<!DOCTYPE html>
<html style=" height:100%;">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="/styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>


<script src="https://kit.fontawesome.com/f6cbba0704.js" crossorigin="anonymous"></script>
 <!-- -----------------jquery----------------- -->
 <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<!-- --------------bootstrap--------------------- -->

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<!-- -------------------datatables-------------------- -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.6/sb-1.3.3/sp-2.0.1/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.6/sb-1.3.3/sp-2.0.1/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>





<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/Chart.min.js"></script> -->


<link rel="shortcut icon" type="image/x-icon" href="../public/favicon.ico">
  <title><?=$title?></title>
  <script src="/autocom.js"></script>
 
</head>
  <body class="w3-light-grey" > 

 

<header class="p-2 mb-2 bg-primary ">
  <div class="container-fluid">
<h4 class="text-white">Sistema de Vigilancia Nutricional SIVIN.2</h4>

<?php if (isset($_SESSION['username'])) 
{echo  "<p> Usuario: <b>" . $_SESSION['nombre'] .' '.$_SESSION['apellido'].' </b>- ' . 

$_SESSION['establecimiento_nombre']. "</p>";}
//var_dump($_SESSION);
 ?>
</h5>

<!-- <nav class="navbar navbar-expand-sm navbar-light py-0 small bg-light"> -->
<nav class="navbar navbar-expand-sm navbar-light py-0 small bg-light">
    <div class="container">
  <?php if ($loggedIn): ?>
       <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a  class="navbar-brand mb-0 " href="/ninios/home">Inicio</a>
          </li> 
         
          <li class="nav-item">
          <a class="navbar-brand mb-0 " href="/ninios/busca">Carga</a>
          </li>

          <li class="nav-item">
          <a class="navbar-brand mb-0 " href="/lista/nominal">Consulta</a>
          </li>
     
           <!-- <li class="nav-item">
          <a class="navbar-brand mb-0 " href="/antro/antro">Antro</a>
          </li>  -->

          <?php if ($_SESSION['tipo']=='Auditor') { ?>


          <li class="nav-item dropdown">
            <a class="dropdown-toggle navbar-brand mb-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Usuarios
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="navbar-brand mb-0" href="/user/user">Cargar Usuario</a></li>
              <li><a class="navbar-brand mb-0" href="/user/listar">Ver/Editar</a></li>
             </ul>
          </li>
            <?php } ?>
          <li> 
          <a class="nav-item active" aria-current="page" href ="/login/logout">Salir</a>
          </li>
        </ul>
      </div>
    </div>
    <?php else: ?>
      <a class="nav-link active " aria-current="page" href="/login/login">Ingresar con contraseña (Usuarios registrados)</a>
    <?php endif; ?>
  </nav>




</header>
 <main class="w3-row-padding table-container">  
  <div class="w3-container" >
    
  <?=$output ?? ''?>

  </div>  
  </main>
<footer class="p-1 mb-1 bg-primary text-white ">
<div class="container-fluid">

<h6 align="center"> MSP - DNyAS - Sistema de Vigilancia Nutricional</h6>

</div>
</footer>

 


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script src="\datatable.js"> </script>
<script src="\scripts.js"> </script>

 


</body>
</html>