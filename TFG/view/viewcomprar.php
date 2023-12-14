<main class="gamepage">
    <h1 class="admintitulo">Tu Compra</h1>
    <?php
    $cantidad = 1;
    $html="";

    echo "<div class='listcomprarcarro'>";
    $videojuegos = $videojuegoDAO->obtenerVideojuegosId();

    $total = 0;
    if (!empty($videojuegos)) {
        foreach ($videojuegos as $game) {
            echo "<div class='comprarcarro'>";
            echo " <img class='imgcompracarro'  src=" .  $game->getImagen() . " ></img>";
            echo "<li class='listcomprarcarro1'> -" . $game->getTitulo() . "</li>";

            echo "<div class='preciocomprarcarro'> - Precio: " . $game->getPrecio()  . "€</div>";



            echo "</div>";
        }
    }
    echo "</div>";

    $html .= " <div class='formenviar2'>
                        
                        <button onclick='finalizar(" . $game->getIdvideojuego() . ", " . $_SESSION['idUsuario'] . ", " . $cantidad . " )'>Finalizar Compra</a>
                    </div>
               
                    </div>
                    </div>";


    $html .= "</div>";


    echo $html;
    ?>
    <script>
        function finalizar(idjuego, idusuario, cantidad) {

            var fechaActual = new Date();
            var fechaFormateada = fechaActual.toISOString().slice(0, 19).replace("T", " ");;

            $.ajax({
                type: "POST",
                url: "anadircompraindividual.php",
                data: {
                    idjuego: idjuego,
                    idusuario: idusuario,
                    cantidad: cantidad,
                    fechaFormateada: fechaFormateada

                },

                success: function(response) {



                    window.location.href = "ticket.php?id=" + idjuego;
                },
                error: function(error) {
                    console.error("Error al agregar datos a la base de datos", error);
                }
            });
        }
    </script>
</main>