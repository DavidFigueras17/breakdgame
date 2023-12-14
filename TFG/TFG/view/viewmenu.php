<?php
require_once("model/modelusuario.php");
?>
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
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!" onclick="openModal()">Iniciar Sesion</a></li>
            </ul>
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <!-- Contenido del formulario de inicio de sesión -->
                    <form class="formuser">
                        <h2>Iniciar Sesión</h2>
                        <div>
                            <label for="correo">Correo</label>
                            <input type="text" id="correo" placeholder="Ingrese su correo">
                        </div>
                        <div>
                            <label for="contrasena">Contraseña</label>
                            <input type="password" id="contrasena" placeholder="Ingrese su contraseña">
                        </div>
                        <button type="button" onclick="iniciarSesion()">Iniciar Sesión</button>
                        <button type="button" onclick="openModalr()">Registro</button>
                        <div class="error-message" id="error-message"></div>
                    </form>
                </div>
            </div>

            <div id="modalr" class="modalr">
                <div class="modal-content2">
                    <span class="close" onclick=" closeModalr()">&times;</span>
                    <form class="formuser">
                        <h2>Registro</h2>
                        <div>
                            <label for='nombrer'>Nombre</label>
                            <input type='text' id='nombrer' placeholder='Ingrese su nombre'>
                        </div>
                        <div>
                            <label for='apellidor'>Apellido</label>
                            <input type='text' id='apellidor' placeholder='Ingrese su apellido'>
                        </div>
                        <div>
                            <label for='contrasenar'>Contraseña (Minimo 5 caracteres y una letra mayuscula)</label>
                            <input type='password' id='contrasenar' placeholder='Ingrese su contraseña'>
                        </div>
                        <div>
                            <label for='email'>Email</label>
                            <input type='text' id='email' placeholder='Ingrese su email'>
                        </div>


                        <div>
                            <label for='direccion'>Direccion</label>
                            <input type='text' id='direccion' placeholder='Ingrese su direccion'>
                        </div>
                        <div>
                            <label for='fecha'>Nacimiento</label>
                            <input type='date' id='fecha'>
                        </div>
                        <button type='button' onclick='registrar()'>Registro</button>
                        <div class='error-message' id='error-messager'></div>
                    </form>
                </div>
            </div>

            <script>
                function openModal() {
                    document.getElementById("modal").style.display = "flex";
                }

                function openModalr() {
                    closeModal();
                    document.getElementById("modalr").style.display = "flex";
                }

                function closeModal() {
                    document.getElementById("modal").style.display = "none";
                }

                function closeModalr() {
                    document.getElementById("modalr").style.display = "none";
                }

                function closeModalc() {
                    var d = new Date();
                    d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000)); 
                    var expires = "expires=" + d.toUTCString();
                    document.cookie = "aceptarCookies=true;" + expires + ";path=/";
                    document.getElementById("modalc").style.display = "none";
                }

                function iniciarSesion() {
                    var correo = document.getElementById('correo').value;
                    var contrasena = document.getElementById('contrasena').value;

                    $.ajax({
                        type: 'POST',
                        url: 'login.php',
                        data: {
                            correo: correo,
                            contrasena: contrasena
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status === 'success') {
                                var usuario = data.usuario;
                                var usuario_id = data.usuario_id;
                                var administrador = data.administrador;
                                var sesion_iniciada = data.sesion_iniciada;
                                document.cookie = 'usuario=' + encodeURIComponent(usuario);
                                document.cookie = 'usuario_id=' + encodeURIComponent(usuario_id);
                                document.cookie = 'administrador=' + encodeURIComponent(administrador);
                                document.cookie = 'sesion_iniciada=' + encodeURIComponent(sesion_iniciada);

                                window.location.href = 'index.php';
                            } else {
                                document.getElementById('error-message').innerHTML = 'Correo o contraseña incorrectos.';
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error en la solicitud AJAX:", error);
                        }
                    });


                }

                function registrar() {

                    var nombre = document.getElementById('nombrer').value;
                    var apellido = document.getElementById('apellidor').value;
                    var contrasena = document.getElementById('contrasenar').value;
                    var email = document.getElementById('email').value;
                    var direccion = document.getElementById('direccion').value;
                    var fecha = document.getElementById('fecha').value;
                    var errorMensaje = document.getElementById('error-messager');

                    errorMensaje.innerText = '';

                    if (nombre === '' || apellido === '' || contrasena === '' || email === '' || direccion === '' || fecha === '') {
                        errorMensaje.innerText = 'Todos los campos son obligatorios';
                        return;
                    }


                    if (!validarPassword(contrasena)) {
                        errorMensaje.innerText = 'La contraseña debe tener al menos 5 caracteres y una letra en mayúscula';
                        return;
                    }

                    if (!validarEmail(email)) {
                        errorMensaje.innerText = 'El formato del correo electrónico no es válido';
                        return;
                    }

                    $.ajax({
                        type: 'POST',
                        url: 'registro.php',
                        data: {
                            nombre: nombre,
                            apellido: apellido,
                            contrasena: contrasena,
                            email: email,
                            direccion: direccion,
                            fecha: fecha
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registrado con exito',
                                }).then((result) => {

                                    if (result.isConfirmed) {

                                        window.location.href = 'index.php';
                                    }
                                });


                            } else {
                                errorMensaje.innerHTML = 'El correo ya esta en la base de datos.';
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error en la solicitud AJAX:", xhr.responseText);
                        }
                    });


                }


                function validarEmail(email) {
                    var patronEmail = /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/;
                    return patronEmail.test(email);
                }



                function validarPassword(contrasena) {

                    return contrasena.length >= 5 && /[A-Z]/.test(contrasena);
                }
            </script>



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
                    <button type="button" onclick="comprar()">Comprar</button>
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

            function comprar(idjuego, precio, titulo, imagen) {
                Swal.fire({
                    icon: 'error',
                    title: 'No has iniciado sesion.',

                });
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


            function anadirCarritoNouser() {

                Swal.fire({
                    icon: 'error',
                    title: 'No has iniciado sesion.',

                });
                //window.location.href = 'index.php';

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
                        // Manejar la respuesta del servidor si es necesario

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

                // Encontrar el índice del juego en el arreglo carrito utilizando el idjuego
                var index = carrito.findIndex(function(juego) {
                    return juego.idjuego === idjuego;
                });

                if (index !== -1) {
                    // Eliminar el juego del arreglo carrito
                    var juegoEliminado = carrito.splice(index, 1)[0];

                    // Actualizar el localStorage con el carrito modificado
                    localStorage.setItem('carrito', JSON.stringify(carrito));

                    // Actualizar la interfaz eliminando el elemento del DOM
                    var titulosEnCarro = document.querySelectorAll('.carro .titulocarro');
                    for (var i = 0; i < titulosEnCarro.length; i++) {
                        if (titulosEnCarro[i].value == idjuego) {
                            titulosEnCarro[i].parentNode.remove();
                            break;
                        }
                    }

                    // Actualizar el total del carrito
                    actualizarTotalCarrito();
                }
            }
        </script>


    </div>
</nav>