<?php
session_start(); 

if (isset($_SESSION['sesion_iniciada']) && $_SESSION['sesion_iniciada'] === true) {
    // El usuario ha iniciado sesión
    // Puedes acceder a $_SESSION['usuario_id'], $_SESSION['usuario_nombre'], etc.

    require_once("controller/controllerindexsesion.php");

} else {
   
    require_once("controller/controllerindex.php");
}

?>

<!DOCTYPE html>
<html lang="es">



<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Break D' Game</title>
    <!-- Favicon-->

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>
    

   
    <div class="aumentarlimite">
        <button id='aumentarLimite'>Mas</button>
    </div>


    <!-- Footer-->
    <footer class="py-5 bg-dark">

        <p class="m-0 text-center text-white">Copyright &copy; Break D' Game 2023</p>

    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Core theme JS-->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

</html>