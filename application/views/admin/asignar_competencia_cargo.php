<body class="g-sidenav-show  bg-gray-200 animate__fadeIn animate__animated">

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

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
                <!-- <h2 class="font-weight-bolder my-3 mb-4">Personalizar competencias al cargo</h2> -->
                <p>en esta seccion se debe detallar que el administrador puede armar la competencia como el la considere
                    para cargo puntual</p>
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-info shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex ">
                                    <h6 class="text-white  ps-5 mt-2">Competencia Personalizada para el cargo:
                                        <?php echo $cargo->nombre ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
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
                                                <option value="<?php echo $row->id ?>">
                                                    <?php echo $row->codigo . ' - ' . $row->nombre ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select class="form-select" id="select-actividades"
                                            aria-label="Actividades Clave">
                                            <option selected>Selecciona la actividad clave</option>
                                        </select>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <select class="form-select js-example-basic-multiple-limit"
                                            id="select-criterios" aria-label="Criterios">
                                            <option selected>Seleccione uno o más criterios</option>
                                        </select>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <button class="btn btn-success w-100" id="guardar-seleccion">Guardar
                                            competencia</button>
                                    </div>

                                    <div id="seleccion" class="mt-3 "></div>

                                    <!-- <pre><?php // echo print_r($competencias_asignadas, true)     ?></pre> -->
                                    <?php if (empty($competencias_asignadas)): ?>

                                        <div class="alert alert-warning text-center" role="alert">
                                            No hay competencias asignadas para este cargo.
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($competencias_asignadas as $competencia): ?>
                                            <div class="px-4 py-3">
                                                <div class="p-4 card-competencia rounded shadow-sm" style="font-size:12px;">
                                                    <h6 class="mb-0">
                                                        Competencia:
                                                        <?php echo $competencia->nombre; ?>
                                                    </h6>
                                                    <p class="my-2">
                                                        <b>Actividades clave:</b>
                                                    </p>
                                                    <?php foreach ($competencia->actividades as $actividad): ?>
                                                        <div class="card my-2 shadow-sm border-2">
                                                            <div class="card-header p-2">
                                                                <div class="row justify-content-between">
                                                                    <div class="col-auto">
                                                                        <b><?php echo $actividad->nombre; ?></b>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <button type="button"
                                                                            class="btn p-2 py-0 eliminar_actividad"
                                                                            aria-label="Close"
                                                                            data-actividad="<?php echo $actividad->id; ?>"><i
                                                                                class="bi bi-x-circle fs-5 text-danger"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body bg-light p-2">
                                                                <p>
                                                                    <b>Criterios:</b>
                                                                </p>
                                                                <ul>
                                                                    <?php foreach ($actividad->criterios as $criterio): ?>
                                                                        <li>
                                                                            <?php echo $criterio->nombre; ?>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <button class="btn btn-danger btn-sm btn-eliminar"
                                                        data-competencia="<?php echo $competencia->id; ?>">Eliminar
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>




                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>




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
                        $('#select-actividades').append('<option selected>Selecciona la actividad clave</option>');
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
                    url: '<?php echo IP_SERVER ?>Competencias/obtener_criterios',
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
                criterio_id: null
            };

            $('#select-competencias').change(function () {
                seleccion.competencia_id = $(this).val();
                // console.log(seleccion);
                mostrarSeleccion();
            });

            $('#select-actividades').change(function () {
                seleccion.actividad_id = $(this).val();
                // console.log(seleccion);
                mostrarSeleccion();
            });

            $('#select-criterios').change(function () {
                seleccion.criterio_id = $(this).val();
                // console.log(seleccion);
                mostrarSeleccion();
            });


            $('#guardar-seleccion').click(function () {

                // Mostrar SweetAlert para confirmación
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Quieres guardar la competencia para este cargo?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, guardar',
                    confirmButtonColor: 'F', // Cambia el color del botón de confirmación
                    cancelButtonText: 'Cancelar',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        guardarSeleccion();
                        // Si el usuario confirma, llamar a la función para guardar la selección

                        return;

                    }
                });
            });

            var cargo_id = <?php echo $cargo->id; ?>;

            function guardarSeleccion() {
                $.ajax({
                    url: '<?php echo IP_SERVER; ?>Competencias/competencia_personalizada/' + cargo_id,
                    type: 'POST',
                    data: seleccion,
                    dataType: 'json',
                    success: function (response) {
                        Swal.fire({
                            position: "top-end",
                            icon: 'success',
                            title: 'Competencia personalizada creada',
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
                        setTimeout(function () {
                            location.reload();
                        }, 3000);

                    },
                    error: function (xhr, status, error) {
                        console.error('Error al guardar la selección:', xhr.responseText);
                    }
                });
            }
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



        });

        $(document).ready(function () {


            $('.eliminar_actividad').click(function () {
                boton = $(this);
                data = {
                    id_cargo: '<?php echo $cargo->id ?>',
                    id_actividad: $(this).data('actividad')
                };
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Se eliminara la actividad y criterios asociados con esta actividad clave',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f44335',
                    cancelButtonColor: '#5f687f',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('<?php echo IP_SERVER; ?>AsignacionCargoCompetencia/eliminar_actividad', data, function (respuesta) {
                            if (respuesta.success) {
                                if (respuesta.actividades > 0) {
                                    boton.closest('.card').hide('fast')
                                } else {
                                    boton.closest('.card-competencia').hide('fast')
                                }
                            }
                        })
                    }
                });
            });

            $('.btn-eliminar').click(function () {

                var id_cargo = $(this).data('id-cargo');
                var id_criterios = $(this).data('id-criterios').split(',');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción no se puede revertir',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f44335',
                    cancelButtonColor: '#5f687f',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Realizar la solicitud AJAX para eliminar la asignación
                        id_criterios.forEach(function (id_criterio) {
                            $.ajax({
                                url: '<?php echo IP_SERVER; ?>AsignacionCargoCompetencia/eliminar_asignacion',
                                type: 'POST',
                                data: { id_cargo: id_cargo, id_criterio: id_criterio },
                                dataType: 'json',
                                success: function (response) {
                                    if (response.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: '¡Éxito!',
                                            timer: 3000,
                                            timerProgressBar: true,
                                            allowOutsideClick: false,
                                            showConfirmButton: false,
                                            text: response.message
                                        }).then(() => {
                                            // Recargar la página después de la eliminación
                                            setTimeout(function () {
                                                location.reload();
                                            }, 3000);
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: response.message
                                        });
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.error(xhr.responseText);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Hubo un problema al realizar la solicitud'
                                    });
                                }
                            });
                        });
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