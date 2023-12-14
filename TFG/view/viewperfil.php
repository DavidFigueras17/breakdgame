<main>
   
    <?php
   

   $cliente = $clienteDAO->obtenerCliente($_SESSION['idUsuario']);

    // Procesar los resultados de la consulta
    echo"<h1 class='admintitulo'>Historial de compra de ".$cliente->getNombre()."</h1>";
   
    echo "<div class='container1 px-4 px-lg-5 mt-5'>";
    echo "<div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>";
    echo "<div class='listcomprarcarro'>";
    $compras = $compraDAO->obtenerComprasporpersona($_SESSION['idUsuario']);

    $total = 0;
    if (!empty($compras)) {
        foreach ($compras as $compra) {

            $videojuegos = $videojuegoDAO->obtenerVideojuegosIdAdmin($compra->getIdVideojuego());

            $total = 0;
            if (!empty($videojuegos)) {
                foreach ($videojuegos as $game) {
                }
                echo "<div class='comprarcarro'> ".$compra->getFecha()."";
                echo " <img class='imgcompracarro'  src=" .  $game->getImagen() . " ></img>";
                echo "<li class='listcomprarcarro1'> -" . $game->getTitulo() . "</li>";
                
                echo "<li class='licomprarcarro2'> - Cantidad: 1</li>";
                echo "<div class='preciocomprarcarro'> - Precio: " . $game->getPrecio() . "€</div>";



                echo "</div>";
            }
        }
        echo "</div>";
    }
   


    ?>
    
    
</main>