<main>
    <?php

    if (isset($_COOKIE['aceptarCookies']) && $_COOKIE['aceptarCookies'] === 'true') {

       
    } else {

        echo "<div id='modalc' class='modalc'>
    <div class='modal-contentc'>
       
      
        <form class='formuser'>
            <h2>Aceptar Cookies</h2>
          <div>Para poder utilizar la pagina es necesario aceptar la cookie obligatoria</div>
            <button type='button' onclick='closeModalc()'>Aceptar</button>
            
            <div class='error-message' id='error-message'></div>
        </form>
    </div>
</div>";
    }
    ?>
    
    <?php

    $videojuegos = $videojuegoDAO->obtenerVideojuegos();

    // Procesar los resultados de la consulta
    echo "<div class='container1 px-4 px-lg-5 mt-5'>";
    echo "<div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>";


    foreach ($videojuegos as $game) {



        $html = "<div class='col mb-5'>
            <div class='card h-100'>";

        if ($game->getStock() <= 0) {
            $html .= "<div class='badge bg-red text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>Sin Stock</div>";
        } else {
            $html .= "<div class='badge bg-green text-black position-absolute' style='top: 0.5rem; right: 0.5rem'>En Stock</div>";
        }

        $html .= " <!-- Product image-->
                    <a id=" . $game->getIdvideojuego() . " data-title=" . $game->getIdvideojuego() . " href='javascript:void(0);' onclick=GamePage(" . $game->getIdvideojuego() . ")><img class='card-img-top' src=" . $game->getImagen() . " alt='...' /></a>
                    <!-- Product details-->
                    <div class='card-body p-4'>
                        <div class='text-center'>
                            <!-- Product name-->
                            <h5 class='fw-bolder'>" . $game->getTitulo() . "</h5>

                          
                            <!-- Product reviews-->
                            <div class='d-flex justify-content-center small text-warning mb-2'>";

        switch ((int)$game->getPuntuacion()) {

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

        $html .= " <!-- Product price-->
                            
                        <p class='precioindex'>" . $game->getPrecio() . "€</p>
                        </div>
                    </div>";
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
                <button  onclick='anadirCarritoNouser()'>Añadir al carrito</a>
                <button id=" . $game->getIdvideojuego() . " data-id=" . $game->getIdvideojuego() . " href='javascript:void(0);' onclick=comprar(" . $game->getIdvideojuego() . ")>Comprar</a>
            </div>
       
            </div>
            </div>";
            }
        }




        echo $html;
        echo "<script>
        function GamePage(gameId) {
           
            window.location.href = 'gamepage.php?id=' + gameId;
        }
        document.addEventListener('DOMContentLoaded', function() {
            var enlace = document.getElementById(" . $game->getIdvideojuego() . " );

            if (enlace) {
                enlace.addEventListener('click', function(event) {
                    event.preventDefault(); 

                    // Obtener el ID del juego desde el atributo data-title
                    var juegoID = enlace.getAttribute('data-title');

                    
                    GamePage(juegoID);
                });
                
            }
        });
        </script>";

        echo "<script> function comprar(gameid) {

            window.location.href = 'comprar.php?id=' + gameid;
        }
       
       
        
    </script>";
    }

    echo "   
    </div>";


    // Cerrar la conexión a la base de datos

    ?>



    <script>
        // Límite inicial
        var url = "index.php"; // Ruta al mismo archivo
        var count = 0;
        limite = 16;
        // Manejar el clic en el botón "Mas"
        document.addEventListener("DOMContentLoaded", function() {
            var boton = document.getElementById("aumentarLimite");
            limite += 8
            if (boton) {
                boton.addEventListener("click", function() {


                    // Realizar una solicitud AJAX para actualizar el límite
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            aumentarLimite: limite
                        },
                        success: function(data) {
                            count = $(data).find(".card").length;
                            main = $(data).find(".container1");
                            if (limite > count) {

                                boton.remove();
                            }

                            $("main").html(main)


                        }
                    });
                })
            }
        });

        function vaciarCarritoAlEntrar() {
            localStorage.setItem('carrito', JSON.stringify([]));
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