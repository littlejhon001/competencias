<!DOCTYPE html>
<html lang="en">



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
                    <!-- <pre><?php  // echo print_r($cargo, true)                        ?></pre> -->


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

                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">

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
            <h2>Bienvenidos líderes '' </h2>
            <div class="row">
                <!-- <h2 class="font-weight-bolder my-3 mb-4">Asignar evaluadores a
                    <?php // echo $area                            ?>
                </h2> -->
                <p>
                    Gracias por ayudarnos en el proceso de evaluación de competencias de nuestros colaboradores. Por
                    favor, asigna a cada persona el evaluador que hará su respectiva evaluación. Asegúrate de que los
                    evaluadores asignados tengan en cuenta las habilidades y competencias de los colaboradores y que la
                    carga de trabajo sea equitativa. Si tienes alguna pregunta o inquietud, no dudes en comunicarte con
                    el Centro de Excelencia Formación y HRBP.
                </p>
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bs-orange shadow-primary border-radius-lg pt-3 pb-3">
                                <div class="d-flex  ">
                                    <h6 class="text-white text-capitalize ps-4 mt-2">Selecciona los usuarios</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <form class="ms-auto" action="<?php echo IP_SERVER ?>Usuarios/asignar_evaluador/<?php echo encrypt($id_grupo)?>"
                                method="POST" id="formulario-asignacion">
                                <div class="d-flex  px-3">
                                    <select class="form-select me-3" name="evaluador" id="evaluador"
                                        aria-label="Seleccionar opción">
                                        <option selected value="">Selecciona un evaluador ---</option>
                                        <?php foreach ($evaluadores as $row) { ?>
                                            <option value="<?php echo $row->id ?>">
                                                <?php echo $row->nombre . ' ' . $row->apellido ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <!-- <select class="form-select" id="competencia" aria-label="Seleccionar opción"
                                        name="competencia">
                                        <option selected value="">Selecciona la competencia ---</option>
                                        <?php // foreach ($competencias as $row) {                           ?>
                                            <option value=" <?php echo $row->id ?>">
                                                <?php // echo $row->nombre                           ?>
                                            </option>
                                        <?php // }                           ?>

                                    </select> -->
                                    <button id="asignar" type="submit"
                                        class="btn btn-success w-75 m-0 ms-3">Asignar</button>
                                </div>
                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive mx-4 p-0">
                                        <table id="tabla-usuarios-asignar" class="table mx-4 align-items-center mb-0!">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Seleccione</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Nombre</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Apellido</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Cargo</th>
                                                    <!-- <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        numero de competencias asignadas</th> -->

                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach ($usuarios as $row) { ?>
                                                    <tr class="<?php echo ($row->id_evaluador != "") ? 'bg-asignado' : 'bg-sin_asignar'; ?>">
                                                        <td class="align-middle text-center text-sm">
                                                            <?php if (empty($row->id_evaluador)) { ?>
                                                                <input class="mt-2 text-center checkbox-seleccion"
                                                                    type="checkbox" name="usuarios_seleccionados[]"
                                                                    value="<?php echo $row->id ?>">
                                                            <?php } else { ?>
                                                                <input class="mt-2 text-center checkbox-seleccion"
                                                                    type="checkbox" name="usuarios_seleccionados[]"
                                                                    value="<?php echo $row->id ?>" disabled>
                                                            <?php } ?>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex ms-2 flex-column justify-content-center">
                                                                    <?php echo $row->nombre ?>
                                                                    <p class="text-xs text-secondary mb-0">
                                                                        <?php echo $row->email ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h6 class="mb-0 text-sm">
                                                                <?php echo $row->apellido ?>
                                                            </h6>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <?php echo $row->nombre_cargo ?>
                                                        </td>
                                                        <!-- <td class="align-middle text-center text-sm">
                                                            <?php // echo $row->numero_competencias                           ?>
                                                        </td> -->
                                                        <td class="align-middle text-center">
                                                            <a type="button" class=" " data-bs-toggle="modal"
                                                                data-bs-target="#detalles<?php echo $row->id ?>">
                                                                <i class="text-warning bi bi-eye"></i>
                                                            </a>

                                                        </td>
                                                    </tr>

                                                    <div class="modal fade" id="detalles<?php echo $row->id?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Detalle del usuario</h1>
                                                                    <button type="button" class="bg-danger btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="card" style="width: auto;">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Nombres:
                                                                                <?php echo $row->nombre . ' ' . $row->apellido ?>
                                                                            </h5>
                                                                            <h6
                                                                                class="card-subtitle mb-2 text-body-secondary">
                                                                                Cargo:
                                                                                <?php echo $row->nombre_cargo ?>
                                                                            </h6>
                                                                            <p class="card-text">Evaluador:</p>
                                                                            <h6
                                                                                class="text-md <?php echo (!empty($row->nombre_evaluador)) ? 'bg-asignado' : 'bg-sin_asignar'; ?>">
                                                                                Evaluador asignado:
                                                                                <?php echo (!empty($row->nombre_evaluador)) ? $row->nombre_evaluador: 'No asignado' ?>
                                                                            </h6>

                                                                            <p class="card-text">Competencias:</p>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>


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



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Obtener referencia a todos los checkboxes con la clase "checkbox-seleccion"
            const checkboxes = document.querySelectorAll('.checkbox-seleccion');

            // Array para almacenar los identificadores de los elementos seleccionados
            let idsSeleccionados = [];

            // Función para actualizar los IDs seleccionados
            function actualizarIDsSeleccionados() {
                idsSeleccionados = []; // Limpiar el array
                // Iterar sobre los checkboxes y agregar los IDs de los checkboxes seleccionados al array
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        idsSeleccionados.push(checkbox.value);
                    }
                });
                // Imprimir en consola los IDs seleccionados (para propósitos de demostración)
                console.log("IDs seleccionados:", idsSeleccionados);
            }

            // Adjuntar un controlador de eventos de cambio a cada checkbox
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', actualizarIDsSeleccionados);
            });

            // Llamar a la función para actualizar los IDs seleccionados inicialmente
            actualizarIDsSeleccionados();
        });
    </script>

    <script>



        $(document).ready(function () {

            $('#formulario-asignacion').submit(function (event) {
                // Obtener el valor seleccionado del select de evaluador
                var evaluador = $('#evaluador').val();

                // Obtener el valor seleccionado del select de competencia

                // Verificar si el select de evaluador está vacío
                if (evaluador == '') {
                    event.preventDefault();
                    Swal.fire({
                        position: "top-end",
                        icon: 'error',
                        title: 'Error',
                        text: 'Por favor selecciona un evaluador.',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
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
                    return;
                }


                if (!$('.checkbox-seleccion').is(':checked')) {
                    event.preventDefault();
                    Swal.fire({
                        position: "top-end",
                        icon: 'error',
                        title: 'Error',
                        text: 'Selecciona almenos un usuario',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
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
                    event.preventDefault(); // Prevenir el envío del formulario
                    return;
                }
                event.preventDefault(); // Prevenir el envío del formulario
                var formulario = this;
                var formData = new FormData(formulario);

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (respuesta) {
                        if (respuesta.success == 1) {
                            location.reload();
                        } else {
                            console.error("Error:", respuesta.error);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error:", error);
                    }
                });

            });

        });

    </script>


    <script>
        $(document).ready(function () {
            $('#tabla-usuarios-asignar').DataTable({
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
</body>

</html>