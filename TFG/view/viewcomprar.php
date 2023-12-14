<main class="gamepage">
    <?php

    $videojuegos = $videojuegoDAO->obtenerVideojuegosId();
    if (!empty($videojuegos)) {
        $game = $videojuegos[0];

        $html = " <div class='containercomprar'>
        
       <div class='imagencompra'>
        <img  src=" .  $game->getImagen() . " ></img>
        <div class='d-flex justify-content-center x-large text-warning1 mb-2'>";

        switch ((int) $game->getPuntuacion()) {

            case 0:
                $html .=
                    "<div class='bi-star'></div>
                                <div class='bi-star'></div>
                                <div class='bi-star'></div>
                                <div class='bi-star'></div>
                                <div class='bi-star'></div>
                            </div>";
                break;
            case 1:
                $html .=
                    "<div class='bi-star-fill'></div>
                                <div class='bi-star'></div>
                                <div class='bi-star'></div>
                                <div class='bi-star'></div>
                                <div class='bi-star'></div>
                            </div>";
                break;
            case 2:
                $html .=
                    "<div class='bi-star-fill'></div>
                                <div class='bi-star-fill'></div>
                                <div class='bi-star'></div>
                                <div class='bi-star'></div>
                                <div class='bi-star'></div>
                            </div>";
                break;
            case 3:
                $html .=
                    "<div class='bi-star-fill'></div>
                                <div class='bi-star-fill'></div>
                                <div class='bi-star-fill'></div>
                                <div class='bi-star'></div>
                                <div class='bi-star'></div>
                            </div>";
                break;
            case 4:
                $html .=
                    "<div class='bi-star-fill'></div>
                                <div class='bi-star-fill'></div>
                                <div class='bi-star-fill'></div>
                                <div class='bi-star-fill'></div>
                                <div class='bi-star'></div>
                            </div>";
                break;
            case 5:
                $html .=
                    "<div class='bi-star-fill'></div>
                                <div class='bi-star-fill'></div>
                                <div class='bi-star-fill'></div>
                                <div class='bi-star-fill'></div>
                                <div class='bi-star-fill'></div>
                            </div>";
                break;
        }



        $html .= " </div><div class='textgamepage-container'>
        <h1 class='titulogamepage'>" . $game->getTitulo() . "</h1>";
        if ($game->getStock() <= 0) {
            $html .= "<div class='badge bg-red text-white position-relative end-0'   >Sin Stock</div>";
        } else {
            $html .= "<div class='badge bg-green text-black position-relative end-0' >En Stock</div>";
        }
        $html .= "<p class='generogamepage'>Género: " .  $game->getGenero() . "</p>
        <p class='plataformagamepage'>Plataforma: " .  $game->getPlataforma() . "</p><br>
        <p class='sinopsisgamepage'>" .  $game->getSinopsis() . "</p><br><br><br>
        <p class='preciogamepage'>" .  $game->getPrecio() . "€</p>";

        $html .= "<br>";

        //el idusuario esta hecho para comprobar una cosa

        $cliente = $clienteDAO->obtenerCliente($_SESSION['idUsuario']);

        $idcarrito = 0;
        $cantidad = 1;
        $html .= " <div class='form'>
                        
             <label class='formlabel' for='forma_pago'>Forma de Pago:</label>
             <select class='formfinalizar' id='forma_pago' name='forma_pago' required>
                 <option value='tarjeta'>Tarjeta</option>
                 <option value='efectivo'>Efectivo</option>
                 <option value='contrareembolso'>Contrareembolso</option>
             </select>
         
             <br>
         
             <label class='formlabel' for='direccion_envio'>Dirección de Envío:</label>
             <input class='formfinalizar' id='direccion_envio' name='direccion_envio' value=\"" . $cliente->getDireccion() . "\" required>
         
             <br>
                    </div>
               
                    </div>
                    </div>";
        $html .= " <div class='formenviar2'>
                        
                        <button onclick='finalizar(" . $game->getIdvideojuego() . ", " . $_SESSION['idUsuario'] . ", " . $cantidad . " )'>Finalizar Compra</a>
                    </div>
               
                    </div>
                    </div>";


        $html .= "</div></div>";
    }

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
                   


                    window.location.href = "ticket.php?id="+idjuego;
                },
                error: function(error) {
                    console.error("Error al agregar datos a la base de datos", error);
                }
            });
        }
    </script>
</main>