<main>
    <h1 class="admintitulo">Tu Compra:</h1>
    <?php
    $cantidad = 1;
    if (isset($_GET['id0'])) {
        $idjuego1 = $_GET['id0'];

        // Array para mantener un seguimiento de la cantidad para cada idjuego
        $cantidades = array($idjuego1 => $cantidad);

       
        $i = 1;
        while (isset($_GET['id' . $i])) {
            $idjuego = $_GET['id' . $i];

            // Incrementa la cantidad si el idjuego ya existe en el array, o establece la cantidad en 1 si es nuevo
            $cantidades[$idjuego] = isset($cantidades[$idjuego]) ? $cantidades[$idjuego] + 1 : 1;

            $i++;
        }
    } else {
        echo 'No se proporcionaron idjuegos.';
    }
    echo "<div class='listcomprarcarro'>";
    $videojuegos = $videojuegoDAO->obtenerVideojuegosCarro();

    $total = 0;
    if (!empty($videojuegos)) {
        foreach ($videojuegos as $game) {
            echo "<div class='comprarcarro'>";
            echo " <img class='imgcompracarro'  src=" .  $game->getImagen() . " ></img>";
            echo "<li class='listcomprarcarro1'> -" . $game->getTitulo() . "</li>";
            echo "<li class='licomprarcarro2'> - Cantidad: " . $cantidades[$game->getIdvideojuego()] . "</li>";
            echo "<div class='preciocomprarcarro'> - Precio: " . $game->getPrecio() * $cantidades[$game->getIdvideojuego()] . "€</div>";

            $total += $game->getPrecio() * $cantidades[$game->getIdvideojuego()];

            echo "</div>";
        }
        echo "<div class='totalcomprarcarro'>Total: " . $total . "€</div>";
    }

    
    $cliente = $clienteDAO->obtenerCliente($_SESSION['idUsuario']);
    echo " <div class='form'>
                        
    <label class='formlabel' for='forma_pago'>Gracias por la compra ".$cliente->getNombre()."</label>
   </div>";
   echo "</div>";
    ?>
    
</main>