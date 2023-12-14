<!-- Navigation-->

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php">Break D' Game</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li id="Pc" class="nav-item"><a class="nav-link active" onclick="GamePlatform('Pc')" aria-current="page" href="javascript:void(0);" data-platform="Pc">PC</a></li>
                <li id="PS5" class="nav-item"><a class="nav-link active" onclick="GamePlatform('PS5')" aria-current="page" href="javascript:void(0);" data-platform="PS5">PS5</a></li>
                <li id="PS4" class="nav-item"><a class="nav-link active" onclick="GamePlatform('PS4')" aria-current="page" href="javascript:void(0);" data-platform="PS4">PS4</a></li>
                <li id="XBOX" class="nav-item"><a class="nav-link active" onclick="GamePlatform('XBOX')" aria-current="page" href="javascript:void(0);" data-platform="XBOX">XBOX</a></li>
                <li id="SWITCH" class="nav-item"><a class="nav-link active" onclick="GamePlatform('SWITCH')" aria-current="page" href="javascript:void(0);" data-platform="SWITCH">SWITCH</a></li>
                <li id="N3DS" class="nav-item"><a class="nav-link active" onclick="GamePlatform('N3DS')" aria-current="page" href="javascript:void(0);" data-platform="N3DS">NINTENDO3DS</a></li>
            </ul>
            <script>
                function GamePlatform(gameplatform) {

                    window.location.href = 'platform.php?platform=' + gameplatform;
                }
                document.addEventListener('DOMContentLoaded', function() {
                    var enlaces = document.querySelectorAll('.nav-item a[data-platform]');

                    if (enlaces) {
                        enlaces.forEach(function(enlace) {
                            enlace.addEventListener('click', function(event) {
                                event.preventDefault();

                                // Obtener el nombre de la plataforma desde el atributo data-platform
                                var plataforma = enlace.getAttribute('data-platform');

                                // Redirigir a la página de la plataforma utilizando el nombre de la plataforma
                                GamePlatform(plataforma);
                            });
                        });
                    }
                });
            </script>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="" onclick='cerrarsesion() '>Cerrar Sesion</a></li>
            </ul>

            <script>
                function cerrarsesion() {
                    $.ajax({
                        type: 'POST',
                        url: 'cerrar_sesion.php',
                        success: function() {
                            // Recargar la página después de cerrar sesión
                            vaciarCarritoAlEntrar();
                            var sesion_iniciada = false;

                            document.cookie = 'sesion_iniciada=' + encodeURIComponent(sesion_iniciada);
                            window.location.href = 'index.php';
                        }
                    });
                }
            </script>
            <?php


            if (isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] === "1") {
                echo "<ul class='navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4'>
                <li class='nav-item'>
                <a <a class='nav-link active'  aria-current='page' href='perfil.php' class='nav-link'>" . $_SESSION['nombreUsuario'] . "</a></li>
            </ul>";

                echo "<div class='collapse navbar-collapse' id='navbarSupportedContent'>
                <ul class='navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4'>
                    <li id='admin' class='nav-item'><a class='nav-link active'  aria-current='page' href='admin.php' >Pagina Admin</a></li>
                </ul>";
            } else {
                echo "<div class='collapse navbar-collapse' id='navbarSupportedContent'>
                <ul class='navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4'>
                <li class='nav-item'>
                <a <a class='nav-link active'  aria-current='page' href='perfil.php' class='nav-link'>" . $_SESSION['nombreUsuario'] . "</a></li>
            </ul>";
            }
            ?>


        </div>

    </div>
    <form class="d-flex">
        <a class="btn btn-outline-dark" type="submit" onclick="openModalCarrito()">
            <i class="bi-cart-fill me-1"></i>
            Carrito

        </a>
    </form>
    <!--modal para ver el carrito-->
    <div id="modalcarrito" class="modalcarrito">


        <div class="modal-contentcarrito" id="modal-contentcarrito">
            <p class="carronombre">Carrito</p>
            <div class="juegoscarro" id="juegoscarro">

            </div>
            <div class="totalcarro" id="totalcarro">

            </div>
            <div id="formenviar2" class="formenviar2">
                <button type="button" onclick="comprarcarro()">Comprar</button>
                <button type="button" onclick="closeModalCarrito()">Seguir Comprando</button>
                <div class="error-message" id="error-message"></div>
            </div>
        </div>
    </div>
    <script>
        function openModalCarrito() {

            document.getElementById("modalcarrito").style.display = "flex";
        }

        function closeModalCarrito() {
            document.getElementById("modalcarrito").style.display = "none";
        }

        function comprarcarro() {
            var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            var idjuego = carrito.map(function(juego) {
                return juego.idjuego;
            });

            var juegos = '';
            for (var i = 1; i <= idjuego.length; i++) {
                if (i === 1) {
                    juegos += 'id' + (i - 1) + '=' + idjuego[i - 1];
                } else {
                    juegos += '&id' + (i - 1) + '=' + idjuego[i - 1];
                }

            }



            window.location.href = 'comprarcarro.php?' + juegos;

        }





        function sinstock(idjuego, precio, titulo, imagen) {

            Swal.fire({
                icon: 'error',
                title: 'No hay unidades disponibles',
                text: 'Lo sentimos, no quedan unidades de ' + titulo + '.',
            });
        }

        var totalCarritoCreado = false;

        function vaciarCarritoAlEntrar() {
            localStorage.setItem('carrito', JSON.stringify([]));
        }

        function anadirCarrito(idjuego, precio, titulo, imagen, idcarrito) {



            document.getElementById("modalcarrito").style.display = "flex";
            var titulosEnCarro = document.querySelectorAll('.carro .titulocarro');
            var carrito = JSON.parse(localStorage.getItem('carrito')) || [];


            var nuevoJuego = {
                idjuego: idjuego,
                precio: precio,
                titulo: titulo,
                imagen: imagen,
                idcarrito: idcarrito,
            };

            carrito.push(nuevoJuego);

            // Almacenar el carrito actualizado en el almacenamiento local
            localStorage.setItem('carrito', JSON.stringify(carrito));

            var carro = document.createElement('div');
            carro.className = "carro";
            carro.style.display = "flex";
            carro.style.marginBottom = "10px";
            carro.style.borderBottom = "2px solid #ccc";

            var titulocarro = document.createElement('p');
            titulocarro.className = "titulocarro";
            titulocarro.textContent = titulo;
            titulocarro.value = idjuego;
            titulocarro.style.marginLeft = "10px";
            titulocarro.style.marginRight = "10px";



            var preciocarro = document.createElement('div');
            preciocarro.className = "preciocarro"
            preciocarro.textContent = precio + "€";
            preciocarro.style.marginLeft = "auto";
            preciocarro.style.marginRight = "0";


            var totalCarrito = document.createElement('div');
            totalCarrito.className = "totalCarrito";

            document.getElementById("juegoscarro").append(totalCarrito);


            var cantidadSeleccionada = 1;
            var nuevoprecio = precio * cantidadSeleccionada;
            preciocarro.textContent = nuevoprecio + "€";
            var Arrayjuegoscarrito = [idjuego, cantidadSeleccionada, idcarrito];
            $.ajax({
                type: 'GET',
                url: 'index.php',
                data: {
                    juegoscarrito: Arrayjuegoscarrito
                },
                success: function(response) {


                },
                error: function(error) {
                    console.error('Error en la solicitud AJAX: ', error);
                }
            });


            var imgcarro = document.createElement('img');
            imgcarro.className = "imgcarro";
            imgcarro.style.width = "50px";
            imgcarro.style.height = "50px";

            var botonEliminar = document.createElement('button');
            botonEliminar.className = 'eliminarJuego';
            botonEliminar.textContent = 'X';
            botonEliminar.onclick = function() {
                eliminarJuego(idjuego);
            };
            imgcarro.src = imagen;
            carro.append(imgcarro, titulocarro, preciocarro, botonEliminar);
            document.getElementById("juegoscarro").append(carro);
            document.getElementById("totalcarro").append(totalCarrito);



            actualizarTotalCarrito(); // Actualizar el total cuando cambia la cantidad
            setTimeout(function() {
                closeModalCarrito();
            }, 5000);
        }

        function cargarCarrito(idjuego, precio, titulo, imagen, idcarrito) {



           
            var titulosEnCarro = document.querySelectorAll('.carro .titulocarro');
            var carrito = JSON.parse(localStorage.getItem('carrito')) || [];


            var nuevoJuego = {
                idjuego: idjuego,
                precio: precio,
                titulo: titulo,
                imagen: imagen,
                idcarrito: idcarrito,
            };

            carrito.push(nuevoJuego);

            // Almacenar el carrito actualizado en el almacenamiento local
            localStorage.setItem('carrito', JSON.stringify(carrito));

            var carro = document.createElement('div');
            carro.className = "carro";
            carro.style.display = "flex";
            carro.style.marginBottom = "10px";
            carro.style.borderBottom = "2px solid #ccc";

            var titulocarro = document.createElement('p');
            titulocarro.className = "titulocarro";
            titulocarro.textContent = titulo;
            titulocarro.value = idjuego;
            titulocarro.style.marginLeft = "10px";
            titulocarro.style.marginRight = "10px";



            var preciocarro = document.createElement('div');
            preciocarro.className = "preciocarro"
            preciocarro.textContent = precio + "€";
            preciocarro.style.marginLeft = "auto";
            preciocarro.style.marginRight = "0";


            var totalCarrito = document.createElement('div');
            totalCarrito.className = "totalCarrito";

            document.getElementById("juegoscarro").append(totalCarrito);


            var cantidadSeleccionada = 1;
            var nuevoprecio = precio * cantidadSeleccionada;
            preciocarro.textContent = nuevoprecio + "€";
            var Arrayjuegoscarrito = [idjuego, cantidadSeleccionada, idcarrito];
            $.ajax({
                type: 'GET',
                url: 'index.php',
                data: {
                    juegoscarrito: Arrayjuegoscarrito
                },
                success: function(response) {


                },
                error: function(error) {
                    console.error('Error en la solicitud AJAX: ', error);
                }
            });


            var imgcarro = document.createElement('img');
            imgcarro.className = "imgcarro";
            imgcarro.style.width = "50px";
            imgcarro.style.height = "50px";

            var botonEliminar = document.createElement('button');
            botonEliminar.className = 'eliminarJuego';
            botonEliminar.textContent = 'X';
            botonEliminar.onclick = function() {
                eliminarJuego(idjuego);
            };
            imgcarro.src = imagen;
            carro.append(imgcarro, titulocarro, preciocarro, botonEliminar);
            document.getElementById("juegoscarro").append(carro);
            document.getElementById("totalcarro").append(totalCarrito);



            actualizarTotalCarrito(); // Actualizar el total cuando cambia la cantidad
            setTimeout(function() {
                closeModalCarrito();
            }, 5000);
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

        function eliminarJuego(idjuego) {
            var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

            // Encontrar el idjuego
            var index = carrito.findIndex(function(juego) {
                return juego.idjuego === idjuego;
            });

            if (index !== -1) {
                // Eliminar el juego del arreglo carrito
                var juegoEliminado = carrito.splice(index, 1)[0];



                // Actualizar la interfaz eliminando el elemento del DOM
                var titulosEnCarro = document.querySelectorAll('.carro .titulocarro');
                for (var i = 0; i < titulosEnCarro.length; i++) {
                    if (titulosEnCarro[i].value == idjuego) {
                        titulosEnCarro[i].parentNode.remove();
                        break;
                    }
                }
                // Actualizar el localStorage con el carrito modificado
                localStorage.setItem('carrito', JSON.stringify(carrito));
                // Actualizar el total del carrito
                actualizarTotalCarrito();
            }
        }
    </script>
</nav>