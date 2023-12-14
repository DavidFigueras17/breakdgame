<main >
<h1 class="admintitulo">Tu Compra:</h1>
    <?php

    $videojuegos = $videojuegoDAO->obtenerVideojuegosId();
    if (!empty($videojuegos)) {
        $game = $videojuegos[0];

        echo " <div class='listcomprarcarro'>";

        
        echo "<div class='comprarcarro'>";
        echo " <img class='imgcompracarro'  src=" .  $game->getImagen() . " ></img>";
        echo "<li class='listcomprarcarro1'> -" . $game->getTitulo() . "</li>";
        echo "<div class='preciocomprarcarro'> - Precio: " . $game->getPrecio(). "€</div>";

       

        echo "</div>";
    
   

        //el idusuario esta hecho para comprobar una cosa

        $cliente = $clienteDAO->obtenerCliente($_SESSION['idUsuario']);

        $idcarrito = 0;
        $cantidad = 1;
        echo " <div class='form'>
                        
             <label class='formlabel' for='forma_pago'>Gracias por la compra ".$cliente->getNombre()."</label>
            </div>";
            
    }

    
    ?>
    
</main>