<main id='main'>
    <h1 class="admintitulo">Edita los juegos</h1>
    <?php

    $videojuegos = $videojuegoDAO->obtenerVideojuegosadmin();
    if (!empty($videojuegos)) {


        echo "<div class='selecadmin'><label class='selecadmin' for='juegos'>Selecciona un juego:</label>
            <select id='juegos' name='juegos' onchange='mostrarInfoJuego()'>";
        echo "<option></option>";
        foreach ($videojuegos as $game) {

            echo "<option value=" . $game->getIdvideojuego() . ">'" . $game->getTitulo() . "'</option>";
        }
        echo "</select>";
        echo "<div id='infoContainer'>";
        if (isset($_POST['selectedValue'])) {
            $selectedValue = $_POST['selectedValue'];
            $videojuegos = $videojuegoDAO->obtenerVideojuegosIdAdmin($selectedValue);
            if (!empty($videojuegos)) {
                foreach ($videojuegos as $game) {
                    echo "<div class='listaadmin1'>";
                    echo "<div>";
                    echo "-ID: <div id='id' >" . $game->getIdvideojuego() . "</div></div>";
                    echo "<ul>";
                    echo "<li> - Titulo: <input type='text' value='" . $game->getTitulo() . "' name='titulo' id='titulo'></li>";
                    echo "<li> - Genero: <input type='text' value='" . $game->getGenero() . "' name='genero' id='genero'></li>";
                    echo "<li> - Plataforma:  <select name='plataforma' id='plataforma'>
                    <option value='" . $game->getPlataforma() . "'>" . $game->getPlataforma() . "</option>
                    <option value='Todas'>Todas</option>
                    <option value='Pc'>Pc</option>
                    <option value='PS5'>PS5</option>
                    <option value='PS4'>PS4</option>
                    <option value='XBOX'>XBOX</option>
                    <option value='SWITCH'>SWITCH</option>
                    <option value='N3DS'>N3DS</option>
                    
                    </select> </li>";
                    echo "<li> - Precio: <input type='text' value='" . $game->getPrecio() . "' name='precio' id='precio'></li>";
                    echo "<li> - Stock: <input type='text' value='" . $game->getStock() . "' name='stock' id='stock'></li>";
                    echo "<li> - Sinopsis: <input type='text' value='" . $game->getSinopsis() . "' name='sinopsis' id='sinopsis'></li>";
                    echo "<li> - Imagen: <input type='text' value='" . $game->getImagen() . "' name='imagen' id='imagen'></li>";
                    echo "<li> - Puntuacion: <input type='text' value='" . $game->getPuntuacion() . "' name='puntuacion' id='puntuacion'></li>";
                    echo "</ul>";
                    echo " <div class='botonadmin' ><button    onclick='editarJuego()'>Editar Juego</button></div>";
                }
            }
        }
        echo "</div>";
        echo "</div>";
    }

    echo "</div>";

    ?>
    <div id="oculto" style="display: none;"></div>
    <h1 class="admintitulo">Añadir juego</h1>
    <div class='listaadmin'>
        <ul>
            <li> - Titulo: <input type='text' name='tituloa' id='tituloa'></li>
            <li> - Genero: <input type='text' name='generoa' id='generoa'></li>
            <li> - Plataforma: <select name='plataformaa' id='plataformaa'>

                    <option value="Todas">Todas</option>
                    <option value="Pc">Pc</option>
                    <option value="PS5">PS5</option>
                    <option value="PS4">PS4</option>
                    <option value="XBOX">XBOX</option>
                    <option value="SWITCH">SWITCH</option>
                    <option value="N3DS">N3DS</option>

                </select> </li>
            <li> - Precio: <input type='text' name='precioa' id='precioa'></li>
            <li> - Stock: <input type='text' name='stocka' id='stocka'></li>
            <li> - Sinopsis: <input type='text' name='sinopsisa' id='sinopsisa'></li>
            <li> - Imagen: <input type='text' name='imagena' id='imagena'></li>
            <li> - Puntuacion: <input type='text' name='puntuaciona' id='puntuaciona'></li>
        </ul>
        <div class="botonadmin"><button onclick="añadirJuego()">Añadir Juego</button></div>
    </div>

    <h1 class="admintitulo">Lista de compras por cliente</h1>
    <?php

    $clientes = $clienteDAO->obtenerClientetodos();
    if (!empty($clientes)) {


        echo "<div class='selecadmin'><label class='selecadmin' for='clientes'>Selecciona un cliente:</label>
            <select id='clientes' name='clientes' onchange='mostrarInfocliente()'>";
        echo "<option></option>";
        foreach ($clientes as $cliente) {

            echo "<option value=" . $cliente->getIdUsuario() . ">'" . $cliente->getNombre() . " " . $cliente->getApellido() . "'</option>";
        }
    }
    echo "</select>";
    if (isset($_POST['selectedValue2'])) {
        $selectedValue = $_POST['selectedValue2'];

        $clientes = $clienteDAO->obtenerCliente($selectedValue);
        echo "<div>" . $clientes->getNombre() . " " . $clientes->getApellido() . "";
        echo "<div class='listcomprarcarro'>";
        $compras = $compraDAO->obtenerComprasporpersona($selectedValue);

        $total = 0;
        if (!empty($compras)) {
            foreach ($compras as $compra) {

                $videojuegos = $videojuegoDAO->obtenerVideojuegosIdAdmin($compra->getIdVideojuego());

                $total = 0;
                if (!empty($videojuegos)) {
                    foreach ($videojuegos as $game) {
                    }
                    echo "<div class='comprarcarro'>";
                    echo " <img class='imgcompracarro'  src=" .  $game->getImagen() . " ></img>";
                    echo "<li class='listcomprarcarro1'> -" . $game->getTitulo() . "</li>";
                    echo "<li class='licomprarcarro2'> - Cantidad: " . $compra->getCantidad() . "</li>";
                    echo "<div class='preciocomprarcarro'> - Precio: " . $game->getPrecio() . "€</div>";



                    echo "</div>";
                }
            }
        }
    }

    ?>
    <script>
        function mostrarInfoJuego() {
            var selectedValue = document.getElementById('juegos').value;
            console.log(selectedValue);

            $.ajax({
                type: 'POST',
                url: 'admin.php',
                data: {
                    selectedValue: selectedValue
                },
                success: function(response) {

                    document.getElementById('main').innerHTML = response;
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        function mostrarInfocliente() {
            var selectedValue2 = document.getElementById('clientes').value;
            console.log(selectedValue2);

            $.ajax({
                type: 'POST',
                url: 'admin.php',
                data: {
                    selectedValue2: selectedValue2
                },
                success: function(response) {

                    document.getElementById('main').innerHTML = response;
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }



        function validarCampos() {

            var titulo = document.getElementById('titulo').value;
            var genero = document.getElementById('genero').value;
            var plataforma = document.getElementById('plataforma').value;
            var precio = document.getElementById('precio').value;
            var stock = document.getElementById('stock').value;
            var sinopsis = document.getElementById('sinopsis').value;
            var imagen = document.getElementById('imagen').value;
            var puntuacion = document.getElementById('puntuacion').value;

            if (titulo === '' || genero === '' || plataforma === '' || precio === '' || stock === '' || sinopsis === '' || imagen === '' || puntuacion === '') {

                Swal.fire({
                    icon: 'error',
                    title: 'No has rellenado todo el formulario',
                    text: 'Todos los campos son obligatorios. Por favor, completa todos los campos.',
                });
                return false;
            }
            if (puntuacion < 0 || puntuacion > 5) {

                Swal.fire({
                    icon: 'error',
                    title: 'La puntuacion no es correcta',
                    text: 'Tiene que estar entre 0 y 5.',
                });
                return false;
            }



            return true;
        }

        function validarTitulo(tituloa, callback) {
            $.ajax({
                type: 'POST',
                url: 'validatitulo.php',
                data: {
                    tituloa: tituloa
                },
                success: function(response) {

                    // Llamamos a la función de devolución de llamada con el resultado
                    callback(response);
                },
                error: function(error) {
                    console.log('Error:', error);
                    // En caso de error, también llamamos a la función de devolución de llamada con el error
                    callback(null, error);
                }
            });
        }

        function validarCamposAnadir() {
            var tituloa = document.getElementById('tituloa').value;
            var generoa = document.getElementById('generoa').value;
            var plataformaa = document.getElementById('plataformaa').value;
            var precioa = document.getElementById('precioa').value;
            var stocka = document.getElementById('stocka').value;
            var sinopsisa = document.getElementById('sinopsisa').value;
            var imagena = document.getElementById('imagena').value;
            var puntuaciona = document.getElementById('puntuaciona').value;

            if (tituloa === '' || generoa === '' || plataformaa === '' || precioa === '' || stocka === '' || sinopsisa === '' || imagena === '' || puntuaciona === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'No has rellenado todo el formulario',
                    text: 'Todos los campos son obligatorios. Por favor, completa todos los campos.',
                });
                return false;
            }
            if (puntuaciona < 0 || puntuaciona > 5) {
                Swal.fire({
                    icon: 'error',
                    title: 'La puntuacion no es correcta',
                    text: 'Tiene que estar entre 0 y 5.',
                });
                return false;
            }


            return true;
        }


        function añadirJuego() {

            if (validarCamposAnadir()) {
                var tituloa = document.getElementById('tituloa').value;
                var generoa = document.getElementById('generoa').value;
                var plataformaa = document.getElementById('plataformaa').value;
                var precioa = document.getElementById('precioa').value;
                var stocka = document.getElementById('stocka').value;
                var sinopsisa = document.getElementById('sinopsisa').value;
                var imagena = document.getElementById('imagena').value;
                var puntuaciona = document.getElementById('puntuaciona').value;

                validarTitulo(tituloa, function(resultado, error) {

                    if (resultado === "true") {
                        $.ajax({
                            url: 'anadirjuego.php',
                            method: 'POST',
                            data: {

                                tituloa: tituloa,
                                generoa: generoa,
                                plataformaa: plataformaa,
                                precioa: precioa,
                                stocka: stocka,
                                sinopsisa: sinopsisa,
                                imagena: imagena,
                                puntuaciona: puntuaciona

                            },
                            success: function(response) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Añadido con exito',
                                }).then((result) => {

                                    if (result.isConfirmed) {

                                        window.location.href = window.location.href;
                                    }
                                });




                            },
                            error: function(error) {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error al anadir el juego',

                                });
                                console.error(error);
                            }
                        });
                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'El juego ya existe',

                        });

                    }



                });




            }
        }

        function editarJuego() {
            if (validarCampos()) {
                var idadmin = document.getElementById('id').innerHTML;
                var tituloadmin = document.getElementById('titulo').value;
                var generoadmin = document.getElementById('genero').value;
                var plataformaadmin = document.getElementById('plataforma').value;
                var precioadmin = document.getElementById('precio').value;
                var stockadmin = document.getElementById('stock').value;
                var sinopsisadmin = document.getElementById('sinopsis').value;
                var imagenadmin = document.getElementById('imagen').value;
                var puntuacionadmin = document.getElementById('puntuacion').value;


                $.ajax({
                    url: 'actualizarjuego.php',
                    method: 'POST',
                    data: {
                        idadmin: idadmin,
                        tituloadmin: tituloadmin,
                        generoadmin: generoadmin,
                        plataformaadmin: plataformaadmin,
                        precioadmin: precioadmin,
                        stockadmin: stockadmin,
                        sinopsisadmin: sinopsisadmin,
                        imagenadmin: imagenadmin,
                        puntuacionadmin: puntuacionadmin

                    },
                    success: function(response) {


                        window.location.href = window.location.href;


                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al actualizar el juego',

                        });
                        console.error(error);
                    }
                });

            }
        }
    </script>
</main>