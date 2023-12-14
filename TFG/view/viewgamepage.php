<main class="gamepage">
    <?php

    $videojuegos = $videojuegoDAO->obtenerVideojuegosId();
    if (!empty($videojuegos)) {
        $game = $videojuegos[0];
        $htmlboton = "";
        $html = " <div class='containergamepage'>
        
       <div class='imagengamepage'>
        <img  src=" .  $game->getImagen() . " ></img>
        <div>Opinion de nuestros expertos: </div>
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
        $idcarrito = 0;
        if ($game->getStock() <= 0) {

            $html .= " <div class='formenviar2'>
                        <button  onclick='sinstock(" . $game->getIdvideojuego() . "," . $game->getPrecio() . ",\"" . $game->getTitulo() . "\",\"" . $game->getImagen() . "\")'>Añadir al carrito</a>
                        <button  onclick='sinstock(" . $game->getIdvideojuego() . "," . $game->getPrecio() . ",\"" . $game->getTitulo() . "\",\"" . $game->getImagen() . "\")'>Compra</a>
                    </div>
               
                    </div>
                    </div>";
        } else {
            if (isset($_SESSION['sesion_iniciada']) && $_SESSION['sesion_iniciada'] === true) {
                $html .= " <div class='formenviar2'>
                        <button  onclick='anadirCarrito(" . $game->getIdvideojuego() . "," . $game->getPrecio() . ",\"" . $game->getTitulo() . "\",\"" . $game->getImagen() . "\", $idcarrito)'>Añadir al carrito</a>
                        <button id=" . $game->getIdvideojuego() . " data-id=" . $game->getIdvideojuego() . " href='javascript:void(0);' onclick=comprar(" . $game->getIdvideojuego() . ")>Comprar</a>
                    </div>
               
                    </div>
                    </div>";
            } else {
                $html .= " <div class='formenviar2'>
                <button  onclick='anadirCarritosinsesion(" . $game->getIdvideojuego() . "," . $game->getPrecio() . ",\"" . $game->getTitulo() . "\",\"" . $game->getImagen() . "\", $idcarrito)'>Añadir al carrito</a>
                <button id=" . $game->getIdvideojuego() . " data-id=" . $game->getIdvideojuego() . " href='javascript:void(0);' onclick=comprar(" . $game->getIdvideojuego() . ")>Comprar</a>
            </div>
       
            </div>
            </div>";
            }
        }

        $html .= "</div></div>";
        echo "<script> function comprar(gameid) {

            window.location.href = 'comprar.php?id=' + gameid;
        }
        </script>";

        //Parte de los comentarios.


        $html .= "<div class='containergamepage2'>
            <div>
                <h1 class='titulogamepage'>Comentarios</h1>";
        $clientes = $clienteDAO->obtenerClienteComentario();


        foreach ($clientes as $cliente) {




            $opiniones = $opinionDAO->obtenerOpinionesPorVideojuego($_GET['id'], $cliente->getIdusuario());
            foreach ($opiniones as $opinion) {


                $html .= "<div class='comentario'>
                    <p class='usuario'>Usuario: " . $cliente->getNombre() . " " . $cliente->getApellido() . "</p>";



                $html .= "<p class='texto'>" . $opinion->getComentario() . "</p>
                    <div class='d-flex justify-content-left x-large text-warning2 mb-2'>";

                switch ((int)$opinion->getPuntuacion()) {

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

                $html .= "   <p class='correo'>" .  $cliente->getCorreo() . "</p>
            </div>";
            }
            if (isset($_SESSION['sesion_iniciada']) && $_SESSION['sesion_iniciada'] === true) {
                $opiniones2 = $opinionDAO->obtenerOpinionesPorVideojuego($_GET['id'],  $_SESSION['idUsuario']);
                if (empty($opiniones2)) {
                    $htmlboton = "<button type='button'  onclick='anadirCometario(" . $_SESSION['idUsuario'] . ", " . $game->getIdvideojuego() . ")'>Añadir</a>
                                </div>
                                </div>
                            </form>
                            </div>
                        </div>";
                } else {
                    $htmlboton = "<button type='button' onclick='añadirCometarioyaexiste()'>Añadir</a>
                            </div>
                            </div>
                        </form>
                        </div>
                    </div>";
                }
            } else {
                $htmlboton = "<button type='button' onclick='añadirCometariosinsesion()'>Añadir</a>
                            </div>
                            </div>
                        </form>
                        </div>
                    </div>";
            }
        }




        $html .= "</div>
</div>";



        //Caja para meter nuevos comentarios.

        $html .= "<div class='containergamepage2'>
        <div class='comentario'>
        <h2>Añadir un comentario</h2>
        <form class='formcomments' method='get'>
           

            <label for='comentario'>Comentario:</label>
            <textarea class='texto'  id='comentario' name='comentario' rows='4' placeholder='Escribe aqui tu comentario...' required></textarea>
            <div class='formpuntos'>
            <label for='puntuacion'>Puntuación:</label>
            <select id='puntuacion' name='puntuacion'>
                <option value='1'>1 estrella</option>
                <option value='2'>2 estrellas</option>
                <option value='3'>3 estrellas</option>
                <option value='4'>4 estrellas</option>
                <option value='5'>5 estrellas</option>
            </select>
            <div class='formenviar'>";
        $html .= $htmlboton;
    }

    echo $html;



    ?>

    <script>
        function anadirCometario(usuario, idjuego) {
            var comentario = $('#comentario').val();
            var puntuacion = $('#puntuacion').val();

            $.ajax({
                type: 'POST',
                url: 'comentario.php',
                data: {
                    comentario: comentario,
                    puntuacion: puntuacion,
                    usuario: usuario,
                    idjuego: idjuego
                },
                success: function(response) {

                    window.location.href = window.location.href;



                },
                error: function(error) {
                    console.error('Error en la petición AJAX:', error);
                }
            });
        }

        function añadirCometariosinsesion() {
            Swal.fire({
                icon: 'error',
                title: 'No has iniciado sesion',
                text: 'Para añadir un comentario tienes que iniciar sesion.',
            });
        }

        function añadirCometarioyaexiste() {
            Swal.fire({
                icon: 'error',
                title: 'Ya has añadido un comentario a este juego',

            });
        }

        function vaciarCarritoAlEntrar() {
            localStorage.setItem('carrito', JSON.stringify([]));
        }

        function anadirCarritosinsesion() {
            Swal.fire({
                icon: 'error',
                title: 'No has iniciado sesion',
                text: 'Para añadir un juego al carrito tienes que iniciar sesion.',
            });
        }

        function cargarCarritoDesdeLocalStorage() {

            var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            vaciarCarritoAlEntrar();

            for (var i = 0; i < carrito.length; i++) {
                var juego = carrito[i];
                //console.log(juego);


                cargarCarrito(juego.idjuego, juego.precio, juego.titulo, juego.imagen, juego.idcarrito);

            }
        }

        function juegoEnCarrito(idjuego) {

            var juegosEnCarro = document.querySelectorAll('.carro .titulocarro');


            for (var i = 0; i < juegosEnCarro.length; i++) {
                if (juegosEnCarro[i].value === idjuego) {
                    return true;
                }
            }

            return false;
        }

        function actualizarTotalCarrito() {

            var totalCarritoElement = document.querySelector('.totalCarrito');
            var precios = document.querySelectorAll('.preciocarro');
            var total = 0;

            precios.forEach(function(precioElement) {
                total += parseFloat(precioElement.textContent.replace('€', '')) || 0;
            });

            totalCarritoElement.textContent = "Total: " + total.toFixed(2) + "€";
        }

        document.addEventListener('DOMContentLoaded', function() {

            cargarCarritoDesdeLocalStorage();
        });
    </script>
</main>