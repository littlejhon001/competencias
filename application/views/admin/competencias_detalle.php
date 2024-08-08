<body class="g-sidenav-show  bg-gray-200 animate__fadeIn animate__animated">

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">




                    <h6 class="font-weight-bolder mb-0">Bienvenido de nuevo
                        <?php if ($user_data->Rol_ID == 1) { ?>
                            <?php echo $user_data->nombre ?>,
                            has ingresado como administrador
                        <?php } elseif ($user_data->Rol_ID == 2) { ?>
                            <?php echo $user_data->nombre ?>,
                            has ingresado como gestor de evaluadores
                        <?php } elseif ($user_data->Rol_ID == 3) { ?>
                            <?php echo $user_data->nombre ?>,
                            has ingresado como evaluador
                        <?php } elseif ($user_data->Rol_ID == 4) { ?>
                            <?php echo $user_data->nombre ?>,
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

                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <!-- <img src="./assets/img/team-2.jpg" class="avatar avatar-sm  me-3 "> -->
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <!-- <img src="./assets/img/small-logos/logo-spotify.svg" -->
                                                class="avatar avatar-sm bg-gradient-dark me-3 ">
                                            </div>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a href="./pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>

                                <span class="d-sm-inline d-none">
                                    <?php echo $user_data->nombre ?>
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
                <h2 class="font-weight-bolder my-3 mb-4">Vista general de las competencias</h2>

                <div class="container">
                    <div class="">
                        <form method="POST" action="<?php echo IP_SERVER ?>Competencias/competencias_year">
                            <div class="col-4 d-flex align-items-center">
                                <label for="year-select" class="me-2">Seleccione el año</label>
                                <select id="año_seleccionado" name="year" class="form-select"
                                    aria-label="Seleccione el año">
                                    <option value="" disabled selected>Seleccione</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                </select>
                                <button type="submit" class="btn btn-primary ms-2"><i class="bi bi-search"></i></button>
                            </div>
                        </form>

                        <div class="">
                            <button class="btn btn-success mt-1">
                                Agregar competencia
                            </button>
                        </div>
                    </div>

                </div>

                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        </div>
                        <div class="card-body px-0 pb-2">

                            <div class="table-responsive mx-4 p-0">
                                <?php if (!empty($competencias)) { ?>
                                    <table id="tabla-competencias" class="table  mb-0" border="1">
                                        <thead>
                                            <tr>
                                                <th class="my-0 py-0 text-uppercase text-xxs text-secondary opacity-7">
                                                    Nombre
                                                </th>

                                                <th class="my-0 py-0 text-uppercase text-xxs text-secondary opacity-7">
                                                    Código
                                                </th>
                                                <th class="my-0 py-0 text-uppercase text-xxs text-secondary opacity-7">
                                                    Año
                                                </th>
                                                <th class="my-0 py-0 text-uppercase text-xxs text-secondary opacity-7">
                                                    Ver mas
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($competencias as $row) { ?>
                                                <tr
                                                    class="<?php echo ($row['estado'] == 0) ? 'bg-sin_asignar' : (($row['estado'] == 1) ? 'bg-asignado' : ''); ?>">
                                                    <td class="col">
                                                        <div class="text-wrap">
                                                            <h6><?php echo $row['nombre']; ?></h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-wrap">
                                                        <?php echo $row['codigo']; ?>
                                                    </td>
                                                    <td class="text-wrap">
                                                        <?php echo date('Y', strtotime($row['año'])); ?>
                                                    </td>
                                                    <td class="text-wrap">
                                                        <button type="button" class="btn btn-primary btn-competencias"
                                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                            data-competencia='<?php echo json_encode($row) ?>'>
                                                            <i class="bi bi-journal-plus"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="text-wrap">
                                        <h2 class="my-5 text-center">
                                            Seleccione un año
                                        </h2>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detalles de la Competencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>





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

    <!-- datatable -->
    <script>
        $('#tabla-competencias').DataTable({
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
            },
            responsive: true,
            ordering: false,
        });
    </script>


    <script>
        $(function () {
            // Manejar el clic en los botones de competencias
            $(".btn-competencias").click(function () {
                var competencia = $(this).data('competencia');

                var estado = competencia.estado == 1 ? 'Activo' : 'Inactivo';

                // Crear el contenido HTML inicial para el modal
                var modalContent = `
                                        <h3>Nombre: ${competencia.nombre}</h3>
                                        <h4>Código: ${competencia.codigo}</h4>
                                        <h4>Año: ${competencia.año}</h4>
                                        <h4>Estado: ${estado}</h4>
                                        <h3>Actividades clave:</h3>
                                        <div id="modal-actividades">`;

                // Vaciar el contenido actual y agregar el nuevo contenido al cuerpo del modal
                $('#staticBackdrop').find('.modal-body').empty().append(modalContent);

                // Realizar la solicitud AJAX para obtener actividades clave
                $.ajax({
                    url: '<?php echo IP_SERVER ?>/Competencias/obtener_actividades',
                    type: 'POST',
                    data: {
                        competencia_id: competencia.id // Enviar el ID de la competencia al servidor
                    },
                    dataType: 'json', // Asegurarse de que la respuesta se trate como JSON
                    success: function (actividades) {
                        // Vaciar el contenido previo de actividades antes de agregar nuevas
                        $.each(actividades, function (index, actividad) {
                            var actividadHTML = `
                        <h5>${actividad.nombre}</h5>
                        <button class="criterios btn btn-info"
                            data-id_actividad="${actividad.id}">
                            Ver criterios
                        </button>
                    `;
                            $('#modal-actividades').append(actividadHTML);
                        });

                        // Cerrar el div de actividades
                        $('#modal-actividades').append('</div>');
                    },
                    error: function (xhr, status, error) {
                        // Manejar errores
                        $('#modal-actividades').html('<p>Error al cargar las actividades.</p>');
                    }
                });
            });

            // Delegar el evento click para los botones de ver criterios
            $('#staticBackdrop').on('click', '.criterios', function () {
                var actividadId = $(this).data('id_actividad');
                var button = $(this);

                // Limpiar los criterios existentes antes de añadir nuevos
                button.nextUntil('button.criterios').remove();

                $.ajax({
                    url: '<?php echo IP_SERVER ?>/Competencias/obtener_criterios',
                    type: 'POST',
                    data: {
                        actividad_id: actividadId // Enviar el ID de la actividad al servidor
                    },
                    dataType: 'json', // Asegurarse de que la respuesta se trate como JSON
                    success: function (criterios) {
                        // Crear el contenido HTML para los criterios
                        var criteriosHTML = '<h6>Criterios:</h6><ul>';

                        $.each(criterios, function (index, criterio) {
                            criteriosHTML += `<li>${criterio.nombre} - ${criterio.descripcion}</li>`;
                        });

                        criteriosHTML += '</ul>';

                        // Insertar los criterios después del botón correspondiente
                        button.after(criteriosHTML);
                    },
                    error: function (xhr, status, error) {
                        // Manejar errores
                        button.after('<p>Error al cargar los criterios.</p>');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.cambiar-estado').change(function () {
                var url = '<?php echo IP_SERVER ?>';
                var estado = $(this).val();
                var competencia_id = $(this).data('competencia-id'); // Asegúrate de que el nombre del atributo coincida

                $.ajax({
                    url: url + 'Competencias/actualizar_estado',
                    type: 'POST',
                    data: {
                        estado: estado,
                        competencia_id: competencia_id
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                position: "center",
                                icon: "info",
                                title: "Has modificado el estado de la competencia",
                                showConfirmButton: false,
                                timer: 3500,
                                timerProgressBar: true
                            }).then(() => {
                                // Recargar la página después de que el mensaje se ha mostrado
                                window.location.reload();
                            }); // Mensaje de éxito

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message || 'Hubo un error al actualizar el estado.',
                            }); // Mensaje de error
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al actualizar el estado: ' + textStatus,
                        }); // Mensaje de error
                    }
                });
            });
        });
    </script>




    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</body>

</html>