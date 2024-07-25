<body class="g-sidenav-show  bg-gray-200 animate__fadeIn animate__animated">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <!-- <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">index</li>
          </ol> -->
                    <!-- <pre><?php // echo print_r($competencias, true)                          ?></pre> -->


                    <h6 class="font-weight-bolder mb-0">Bienvenido de nuevo
                        <?php if ($this->session->userdata('user_data')->Rol_ID == 1) { ?>
                            <?php echo $this->session->userdata('user_data')->nombre ?>,
                            has ingresado como administrador
                        <?php } elseif ($this->session->userdata('user_data')->Rol_ID == 2) { ?>
                            <?php echo $this->session->userdata('user_data')->nombre ?>,
                            has ingresado como gestor de evaluadores
                        <?php } elseif ($this->session->userdata('user_data')->Rol_ID == 3) { ?>
                            <?php echo $this->session->userdata('user_data')->nombre ?>,
                            has ingresado como evaluador
                        <?php } elseif ($this->session->userdata('user_data')->Rol_ID == 4) { ?>
                            <?php echo $this->session->userdata('user_data')->nombre ?>,
                            has ingresado como usuario
                        <?php } ?>

                    </h6>

                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">


                    </div>
                    <ul class="navbar-nav  justify-content-end">

                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a>


                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a href="./pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>

                                <span class="d-sm-inline d-none">
                                    <?php echo $this->session->userdata('user_data')->nombre ?>
                                    </php>
                                </span>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <h2>Aula competencias</h2>
            <div class="row">
                <h2 class="font-weight-bolder my-3 mb-4">Asignar competencias por cargos</h2>
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-info shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex ">
                                    <h6 class="text-white  ps-5 mt-2">Seleccione un cargo o asigne competencias desde
                                        esta sección</h6>

                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div id="loader" class="text-center" style="display: none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <div id="loader-criterios" class="text-center" style="display: none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <div class="row m-3">
                                <div class="col-6">

                                    <select class="form-select" id="select-competencias" aria-label="Competencias">
                                        <option selected>Selecciona la competencia</option>
                                        <?php foreach ($competencias as $row) { ?>
                                            <option value="<?php echo $row['id']; ?>">
                                                <?php echo $row['nombre']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-select" id="select-actividades" aria-label="Actividades Clave">
                                        <option selected>Selecciona la actividad clave</option>
                                    </select>
                                </div>

                                <div class="col-6 mt-2">
                                    <select class="form-select" id="select-criterios" aria-label="Criterios">
                                        <option selected>Seleccione uno o más criterios</option>
                                    </select>
                                </div>

                                <div class="col-6 mt-2">
                                    <button class="btn btn-success w-100" id="guardar-competencia-cargos">Asignar
                                        competencia para varios cargos</button>
                                </div>

                                <div id="seleccion" class="mt-3 "></div>

                                <!-- <pre><?php // echo print_r($competencias_asignadas, true)                             ?></pre> -->

                            </div>
                            <div class="table-responsive mx-4 p-0">
                                <table id="tabla-cargos" class="table">
                                    <thead>
                                        <tr>
                                            <th>Seleccionar</th>
                                            <th>Nombre</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cargos as $row): ?>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" class="checkbox-cargos"
                                                        value="<?php echo $row->id ?>">
                                                </th>

                                                <td>
                                                    <?php echo $row->nombre ?>
                                                </td>
                                                <td class="text-center">
                                                    <a
                                                        href="<?php echo IP_SERVER ?>Competencias/asignar_competencia/<?php echo $row->id ?>">
                                                        <i class="text-success bi bi-clipboard2-plus"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>



    <script>

    </script>



    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">settings</i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Material UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark"
                        onclick="sidebarType(this)">Dark</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent"
                        onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                            onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                            onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <a class="btn bg-gradient-info w-100"
                    href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
                <a class="btn btn-outline-dark w-100"
                    href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View
                    documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard"
                        data-icon="octicon-star" data-size="large" data-show-count="true"
                        aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard"
                        class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard"
                        class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->

    <script>

        $(document).ready(function () {

            $('#select-competencias').change(function () {
                var competencia_id = $(this).val();
                // Mostrar el loader
                $('#loader').show();
                $.ajax({
                    url: '<?php echo IP_SERVER ?>Competencias/obtener_actividades',
                    type: 'POST',
                    data: { competencia_id: competencia_id },
                    dataType: 'json',
                    success: function (data) {
                        // Limpiar opciones anteriores
                        $('#select-actividades').empty();

                        // Agregar la opción "Seleccione una competencia" al principio
                        $('#select-actividades').append('<option selected>Seleccione una actividad clave</option>');
                        // Agregar las nuevas opciones
                        $.each(data, function (index, actividad) {
                            $('#select-actividades').append('<option value="' + actividad.id + '">' + actividad.nombre + '</option>');
                        });

                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                    complete: function () {
                        // Ocultar el loader cuando la solicitud AJAX haya finalizado (ya sea con éxito o con error)
                        $('#loader').hide();
                    }
                });
            });

            $('#select-actividades').change(function () {
                var actividad_id = $(this).val();
                $('#loader-criterios').show(); // Mostrar el loader

                $.ajax({
                    url: '<?php echo base_url('Competencias/obtener_criterios'); ?>',
                    type: 'POST',
                    data: { actividad_id: actividad_id },
                    dataType: 'json',
                    success: function (data) {
                        $('#select-criterios').empty(); // Limpiar opciones anteriores
                        $('#select-criterios').append('<option selected disabled>Seleccione un criterio</option>');
                        $('#select-criterios').attr('multiple', 'multiple');

                        $.each(data, function (index, criterio) {
                            $('#select-criterios').append('<option value="' + criterio.id + '">' + criterio.nombre + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                    complete: function () {
                        $('#loader-criterios').hide(); // Ocultar el loader
                    }
                });
            });


            var seleccion = {
                competencia_id: null,
                actividad_id: null,
                criterio_id: null,
                idsSeleccionados: null
            };

            $('#select-competencias').change(function () {
                seleccion.competencia_id = $(this).val();
                console.log(seleccion);
                mostrarSeleccion();
            });

            $('#select-actividades').change(function () {
                seleccion.actividad_id = $(this).val();
                console.log(seleccion);
                mostrarSeleccion();
            });

            $('#select-criterios').change(function () {
                seleccion.criterio_id = $(this).val();
                // console.log(seleccion);
                mostrarSeleccion();
            });

            function mostrarSeleccion() {
                var competenciaSeleccionada = $('#select-competencias option:selected').text();
                var actividadSeleccionada = $('#select-actividades option:selected').text();
                var criterios_seleccionados = $('#select-criterios option:selected').map(function () {
                    return '<li>' + $(this).text() + '</li>'; // Envuelve cada criterio seleccionado en <li>
                }).get().join(''); // Une los elementos de la lista sin separador

                var seleccionHTML = '<p><b>Competencia seleccionada:</b><br> ' + competenciaSeleccionada + '</p>';
                seleccionHTML += '<p><b>Actividad seleccionada:</b> <br>' + actividadSeleccionada + '</p>';
                seleccionHTML += '<p><b>Criterios seleccionados:</b></p><ul>' + criterios_seleccionados + '</ul>'; // Agrega <ul> para la lista

                $('#seleccion').addClass('animate__animated animate__fadeInUp').html(seleccionHTML);


            }



            const tablaCargos = document.getElementById('tabla-cargos');

            // Array para almacenar los identificadores de los elementos seleccionados
            let idsSeleccionados = [];

            // Función para actualizar los IDs seleccionados
            function actualizarIDsSeleccionados() {
                const checkboxes = tablaCargos.querySelectorAll('.checkbox-cargos'); // Definir checkboxes dentro de esta función
                // Iterar sobre los checkboxes y agregar los IDs de los checkboxes seleccionados al array
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked && !idsSeleccionados.includes(checkbox.value)) {
                        idsSeleccionados.push(checkbox.value);
                    } else if (!checkbox.checked && idsSeleccionados.includes(checkbox.value)) {
                        // Si el checkbox está desmarcado, eliminar el ID del array
                        const index = idsSeleccionados.indexOf(checkbox.value);
                        idsSeleccionados.splice(index, 1);
                    }
                });

            }

            // Adjuntar un controlador de eventos de cambio al contenedor de la tabla
            tablaCargos.addEventListener('change', function (event) {
                // Verificar si el cambio provino de un checkbox
                if (event.target.classList.contains('checkbox-cargos')) {
                    // Llamar a la función para actualizar los IDs seleccionados
                    actualizarIDsSeleccionados();
                }
            });

            // Llamar a la función para actualizar los IDs seleccionados inicialmente
            actualizarIDsSeleccionados();


            $('#guardar-competencia-cargos').click(function () {
                // Verificar si hay al menos dos checks seleccionados
                if (idsSeleccionados.length < 2) {
                    // Mostrar un mensaje de advertencia si no hay suficientes checks seleccionados
                    Swal.fire({
                        icon: 'warning',
                        title: 'Seleccione al menos dos cargos',
                        text: 'Por favor, seleccione al menos dos cargos para guardar la competencia',
                    });
                    return; // Detener el flujo si no hay suficientes checks seleccionados
                }


                // Verificar si se ha seleccionado una competencia, actividad y criterio
                if (!seleccion.competencia_id || !seleccion.actividad_id || !seleccion.criterio_id) {
                    // Mostrar un mensaje de advertencia si no se han seleccionado los elementos necesarios
                    Swal.fire({
                        icon: 'warning',
                        title: 'Seleccione una competencia, actividad y criterio',
                        text: 'Por favor, seleccione una competencia, actividad y criterio para guardar la competencia',
                    });
                    return; // Detener el flujo si no se han seleccionado los elementos necesarios
                }

                // Si hay suficientes checks seleccionados y se han seleccionado los elementos necesarios, mostrar el diálogo de confirmación
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Quieres guardar la competencia para los cargos seleccionados?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, guardar',
                    confirmButtonColor: 'F', // Cambia el color del botón de confirmación
                    cancelButtonText: 'Cancelar',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Actualizar los IDs seleccionados antes de guardar
                        actualizarIDsSeleccionados();

                        // Si el usuario confirma, llamar a la función para guardar la selección
                        guardarSeleccion();
                    }
                });
            });



            function guardarSeleccion() {
                seleccion.idsSeleccionados = idsSeleccionados;
                $.ajax({
                    url: '<?php echo IP_SERVER; ?>Competencias/competencia_personalizada_cargos',
                    type: 'POST',
                    data: seleccion,
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            // Si la respuesta es exitosa, muestra un mensaje de éxito
                            Swal.fire({
                                position: "top-end",
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                allowOutsideClick: false,
                                showClass: {
                                    popup: `
                            animate__animated
                            animate__fadeInRight
                            animate__faster
                            `
                                },
                                hideClass: {
                                    popup: `
                            animate__animated
                            animate__fadeOutRight
                            `
                                }
                            });
                            // Recarga la página después de 3 segundos
                            setTimeout(function () {
                                location.reload();
                            }, 5000);
                        } else {
                            // Si hay un error en la respuesta, muestra un mensaje de error
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        // Si hay un error en la solicitud AJAX, muestra un mensaje de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error al procesar la solicitud'
                        });
                    }
                });
            }


        });




    </script>


    <script>

        $('#tabla-cargos').DataTable({
            "paging": true,
            "pageLength": 20,
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                "infoFiltered": "(filtrado de _MAX_ entradas totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": activar para ordenar la columna en orden ascendente",
                    "sortDescending": ": activar para ordenar la columna en orden descendente"
                }
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#select-competencias').select2({
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%',
            });
        });
    </script>




</body>

</html>