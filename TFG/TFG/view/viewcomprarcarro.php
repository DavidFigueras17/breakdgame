<main>
    <h1 class="admintitulo">Tu Carrito</h1>
    <?php
    $cantidad = 1;
    if (isset($_GET['id0'])) {
        $idjuego1 = $_GET['id0'];

        // Array para mantener un seguimiento de la cantidad para cada idjuego
        $cantidades = array($idjuego1 => $cantidad);

        // Verifica si hay más parámetros y recógelos
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

    echo "</div>
    <div class='formenviar2'>

        <button onclick='finalizar( " . $_SESSION['idUsuario'] . ", " .  $cantidades[$game->getIdvideojuego()] . " )'>Finalizar Compra</a>
    </div>";


    ?>
    
    <script>
        function finalizar(idusuario, cantidad) {
            var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            var idjuego = carrito.map(function(juego) {
                return juego.idjuego;
            });
          
            var fechaActual = new Date();
            var fechaFormateada = fechaActual.toISOString().slice(0, 19).replace("T", " ");;
            var juegos = '';
            for (var i = 1; i <= idjuego.length; i++) {
                if (i === 1) {
                    juegos += 'id' + (i - 1) + '=' + idjuego[i - 1];
                } else {
                    juegos += '&id' + (i - 1) + '=' + idjuego[i - 1];
                }

            }
            var fechaActual = new Date();
            var fechaFormateada = fechaActual.toISOString().slice(0, 19).replace("T", " ");;

            $.ajax({
                type: "POST",
                url: "anadircompra.php",
                data: {
                    idjuego: idjuego,
                    idusuario: idusuario,
                    cantidad: cantidad,
                    fechaFormateada: fechaFormateada

                },

                success: function(response) {
                    console.log(idjuego);
                    console.log(cantidad);
                    console.log(response);
                    window.location.href = 'ticketcarro.php?' + juegos;
                },
                error: function(error) {
                    console.error("Error al agregar datos a la base de datos", error);
                }
            });


           
           
        }
    </script>
</main>