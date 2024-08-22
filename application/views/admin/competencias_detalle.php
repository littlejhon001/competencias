<?php
$now = date('Y-m-d H:i:s');
?>

<body class="g-sidenav-show  bg-gray-200 animate__fadeIn animate__animated">

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-lg" id="navbarBlur"
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
                    <div class="d-flex">
                        <div>
                            <form method="POST" action="<?php echo IP_SERVER ?>Competencias/competencias_year"
                                class="w-auto">
                                <div class=" d-flex align-items-center">
                                    <label for="year-select" class="w-25 me-2">Seleccione el año</label>
                                    <select id="año_seleccionado" name="year" class="form-select"
                                        aria-label="Seleccione el año">
                                        <option value="" <?php echo (empty($año)) ? "selected disabled" : "" ?>>
                                            Seleccione</option>
                                        <option value="2024" <?php echo (!empty($año) && ($año) == '2024') ? "selected" : "" ?>>2024</option>
                                        <option value="2023" <?php echo (!empty($año) && ($año) == '2023') ? "selected" : "" ?>>2023</option>
                                        <option value="2022" <?php echo (!empty($año) && ($año) == '2022') ? "selected" : "" ?>>2022</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary ms-2"><i
                                            class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="ms-auto">
                            <?php if (!empty($competencias_nuevas)) { ?>
                                <button class="btn btn-success mt-1" disabled type="button" data-bs-toggle="modal"
                                    data-bs-target="#modal_add_competencia">
                                    Agregar competencia
                                </button>
                            <?php } else { ?>
                                <button class="btn btn-success mt-1" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modal_add_competencia">
                                    Agregar competencia
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-center">
                            <?php if (empty($competencias_nuevas)) { ?>
                                <div class="text-wrap">
                                    <p class="my-5 text-center">
                                        No hay competencias nuevas, comienza creando una
                                    </p>
                                </div>
                            <?php } else {
                                foreach ($competencias_nuevas as $row) { ?>
                                    <div class="col-8 my-2" id="competencia">
                                        <h2>
                                            Estas creando/editando la competencia:
                                        </h2>
                                        <div class="card " style="">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center  ">
                                                    <h4 class="card-title">
                                                        <?php echo $row->nombre ?>
                                                    </h4>
                                                    <div class="">
                                                        <button class="border-0 btn me-2 btn_editar_competencia"
                                                            data-id_competencia="<?php echo $row->id ?>"
                                                            data-nombre_competencia="<?php echo $row->nombre ?>"
                                                            data-descripcion_competencia="<?php echo $row->descripcion ?>"
                                                            data-codigo_competencia="<?php echo $row->codigo ?>"
                                                            data-fecha="<?php echo $row->fecha ?>"
                                                            data-fecha_vigencia="<?php echo $row->fecha_vigencia ?>"
                                                            data-version="<?php echo $row->version ?>"
                                                            data-codigo_año="<?php echo $row->año ?>" data-bs-toggle="modal"
                                                            data-bs-target="#modal_add_competencia">
                                                            <i class="text-warning bi fs-4 bi-pencil-square">
                                                            </i>
                                                        </button>
                                                        <button class="border-0 btn me-2" id="eliminar_competencia"
                                                            data-id_competencia="<?php echo $row->id ?>">
                                                            <i class="text-danger fs-4 bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <p class="card-text mt-2">
                                                    Descripción: <?php echo $row->descripcion ?>
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <p>
                                                        Código: <?php echo $row->codigo ?>
                                                    </p>
                                                    <p>
                                                        Año: <?php echo $row->año ?>
                                                    </p>
                                                </div>

                                                <?php
                                                if (empty($row->actividades)) { ?>
                                                    <h5 class="text-center text-info">
                                                        No tienes Actividades, comienza agregando una.
                                                    </h5>
                                                <?php } else {
                                                    foreach ($row->actividades as $actividades) { ?>
                                                        <div class="card my-2" id="actividad_<?php echo $actividades->id ?>">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <h5 class="card-title">
                                                                        <span class="text-dark">
                                                                            Nombre de la actividad:
                                                                        </span>
                                                                        <?php echo $actividades->nombre ?>
                                                                    </h5>
                                                                    <div>
                                                                        <button type="button"
                                                                            class="border-0 m-0 p-0 btn eliminar_actividad"
                                                                            data-id_actividad="<?php echo $actividades->id ?>">
                                                                            <i class="fs-5 bi-trash text-danger"></i>
                                                                        </button>
                                                                        <button class="border-0 m-0 p-0 btn btn_editar_actividad"
                                                                            data-id_actividad="<?php echo $actividades->id ?>"
                                                                            data-id_competencia="<?php echo $row->id ?>"
                                                                            data-nombre_actividad="<?php echo $actividades->nombre ?>"
                                                                            type="button" data-bs-toggle="modal"
                                                                            data-bs-target="#modal_actividad"
                                                                            data-id_competencia="<?php echo $row->id ?>"> </i>

                                                                            <i class="text-warning bi fs-5 bi-pencil-square"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <?php if (empty($actividades->criterios)) { ?>
                                                                    <h6>
                                                                        No tienes criterios, comienza agregando uno
                                                                    </h6>
                                                                <?php } else {
                                                                    foreach ($actividades->criterios as $criterios) { ?>
                                                                        <div class="card my-1">
                                                                            <div class="card-body">
                                                                                <div class="d-flex justify-content-between">
                                                                                    <p class="m-0 p-0">
                                                                                        Nombre del criterio: <?php echo $criterios->nombre ?>
                                                                                    </p>
                                                                                    <div>
                                                                                        <button type="button"
                                                                                            class="border-0 m-0 p-0 btn eliminar_criterio"
                                                                                            data-id_criterio="<?php echo $criterios->id ?>">
                                                                                            <i class="fs-5 bi-trash text-danger"></i>
                                                                                        </button>
                                                                                        <button
                                                                                            class="border-0 m-0 p-0 btn btn_editar_criterio "
                                                                                            data-id_criterio="<?php echo $criterios->id ?>"
                                                                                            data-nombre_criterio="<?php echo $criterios->nombre ?>"
                                                                                            data-id_actividad="<?php echo $actividades->id ?>"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#modal_criterio">
                                                                                            <i
                                                                                                class="text-warning bi fs-5 bi-pencil-square"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php }
                                                                } ?>
                                                            </div>
                                                            <div class="card-footer">
                                                                <button type="button" class="btn btn-success agregar_criterio"
                                                                    data-id_actividad="<?php echo $actividades->id ?>" type="button"
                                                                    data-bs-toggle="modal" data-bs-target="#modal_criterio">
                                                                    Agregar criterio</button>
                                                            </div>
                                                        </div>
                                                    <?php }
                                                } ?>
                                            </div>
                                            <div class="card-footer ms-auto">
                                                <a href="#" class="btn btn-success agregar_actividad " type="button"
                                                    data-bs-toggle="modal" data-bs-target="#modal_actividad"
                                                    data-id_competencia="<?php echo $row->id ?>">Agregar actividad</a>
                                            </div>
                                            <div class="card-footer">
                                                <button type="button"
                                                    class="btn btn-success w-100 mt-2 guardar_competencia_completa"
                                                    data-id_competencia="<?php echo $row->id ?>">Guardar competencia</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
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
                                                Estado
                                            </th>
                                            <th class="my-0 py-0 text-uppercase text-xxs text-secondary opacity-7">
                                                Ver mas
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($competencias as $row) { ?>
                                            <tr
                                                class="<?php echo ($row->estado == 0) ? 'bg-sin_asignar' : (($row->estado == 1) ? 'bg-asignado' : ''); ?>">
                                                <td class="col">
                                                    <div class="text-wrap">
                                                        <h6><?php echo $row->nombre; ?></h6>
                                                    </div>
                                                </td>
                                                <td class="text-wrap">
                                                    <?php echo $row->codigo; ?>
                                                </td>
                                                <td class="text-wrap">
                                                    <?php echo $row->año; ?>
                                                </td>
                                                <td class="text-wrap">
                                                    <select class="cambiar-estado"
                                                        data-competencia-id="<?php echo $row->id; ?>">
                                                        <option value="1" <?php echo $row->estado == 1 ? 'selected' : ''; ?>>
                                                            Activo</option>
                                                        <option value="2" <?php echo $row->estado == 2 ? 'selected' : ''; ?>>
                                                            Inactivo</option>
                                                    </select>

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
    <!--    modal crear competencia -->
    <div class="modal fade" id="modal_add_competencia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modal_add_competencia" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 titulo_modal" id="modal_add_competencia">Agregar competencia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="crear_competencia_form">
                        <div class="row">
                            <input type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" name="fecha_creacion">
                            <input type="hidden" value="2" name="estado">
                            <input type="hidden" name="id_competencia" id="id_competencia">
                            <div class="col-12">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="border form-control" id=""
                                    placeholder="Nombre de la competencia">
                            </div>
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" rows="3" name="descripcion"
                                    placeholder="Descripcion"></textarea>
                            </div>
                            <div class="col-6">
                                <label for="codigo" class="form-label">Código</label>
                                <input type="text" name="codigo" class="border form-control" id="codigo"
                                    placeholder="Codigo">
                            </div>

                            <div class="col-6">
                                <label for="codigo" class="form-label">Fecha</label>
                                <input type="text" name="fecha" class="border form-control" id="fecha"
                                    placeholder="fecha">
                            </div>
                            <div class="col-6">
                                <label for="codigo" class="form-label">Fecha vigencia</label>
                                <input type="text" name="fecha_vigencia" class="border form-control" id="fecha_vigencia"
                                    placeholder="fecha vigencia">
                            </div>
                            <div class="col-6">
                                <label for="version" class="form-label">Version</label>
                                <input type="text" name="version" class="border form-control" id="version"
                                    placeholder="Version">
                            </div>
                            <button type="button"
                                class="me-2 ms-auto w-50 btn btn-success mt-4 guardar_competencia">Crear
                                competencia</button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal actividad -->
    <div class="modal fade" id="modal_actividad" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 titulo_modal_actividad" id="staticBackdropLabel">Agregar actividad</h1>
                    <button type="button" class="btn-close bg-warning" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="crear_actividad_form">
                        <input id="id_competencia_actividad" type="hidden" value="" name="id_competencia">
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" id="id_actividad" name="id_actividad" value="">
                                <label for="nombre" class="form-label">Nombre de la actividad</label>
                                <input type="text" name="nombre" class="border form-control" id="nombre_actividad"
                                    placeholder="Nombre de la actividad">
                            </div>
                        </div>
                        <div class="mt-3 ms-end">
                            <button type="button" id="crear_actividad" class="btn btn-success ">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal criterio-->
    <div class="modal fade" id="modal_criterio" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" class="" id="crear_criterio_form">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 titulo_modal_criterio" id="staticBackdropLabel">Agregar criterio
                        </h1>
                        <button type="button" class="btn-close bg-warning" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input id="id_actividad_criterio" type="hidden" value="" name="id_actividad_criterio">
                        <input id="id_criterio" type="hidden" value="" name="id_criterio">
                        <div class="row">
                            <div class="col-12">
                                <label for="nombre" class="form-label">Nombre del criterio</label>
                                <input type="text" name="criterio" class="border form-control" id="nombre_criterio"
                                    placeholder="Nombre del criterio">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="crear_criterio">Guardar criterio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {

            $('.agregar_actividad').click(function () {
                $('#id_actividad').val('');
                $('#nombre_actividad').val('');
            });
            $('.agregar_criterio').click(function () {
                $('#id_criterio').val('');
                $('#nombre_criterio').val('');
            });

            $('.agregar_actividad').click(function () {
                var competencia_id = $(this).data('id_competencia');
                $('#id_competencia_actividad').val(competencia_id);
            });

            $('.agregar_criterio').click(function () {
                var id_actividad = $(this).data('id_actividad');
                $('#id_actividad_criterio').val(id_actividad);
            });
        });

        $(document).ready(function () {
            $('#crear_actividad').click(function () {
                Swal.fire({
                    title: "Esta seguro de crear la actividad?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Si",
                    denyButtonText: `No cerrar`,
                    confirmButtonColor: "#3085d6",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        var formData = $('#crear_actividad_form').serialize();
                        $.ajax({
                            url: '<?php echo IP_SERVER ?>Actividad/crear_actividad',
                            type: 'POST',
                            data: formData,
                            success: function (response) {
                                // Manejar la respuesta del servidor aquí
                                Swal.fire({
                                    title: "Actividad creada!",
                                    icon: "success",
                                    showConfirmButton: false
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            },
                            error: function (xhr, status, error) {
                                // Manejar errores aquí
                                Swal.fire("ooppps.. ocurrió un error !", "", "error");
                            }
                        });


                    } else if (result.isDenied) {
                        Swal.fire("Cambios no aplicados", "", "info");
                    }
                });


            });

            $('#crear_criterio').click(function () {
                Swal.fire({
                    title: "Esta seguro de crear el criterio?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Si",
                    denyButtonText: `No cerrar`,
                    confirmButtonColor: "#3085d6",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        var formData = $('#crear_criterio_form').serialize();
                        $.ajax({
                            url: '<?php echo IP_SERVER ?>Criterio/crear_criterio',
                            type: 'POST',
                            data: formData,
                            success: function (response) {
                                // Manejar la respuesta del servidor aquí
                                Swal.fire({
                                    title: "Criterio creado!",
                                    icon: "success",
                                    showConfirmButton: false
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            },
                            error: function (xhr, status, error) {
                                // Manejar errores aquí
                                Swal.fire("ooppps.. ocurrió un error !", "", "error");
                            }
                        });


                    } else if (result.isDenied) {
                        Swal.fire("Cambios no aplicados", "", "info");
                    }
                });


            });

            $('.eliminar_actividad').click(function () {
                Swal.fire({
                    title: "Esta seguro de eliminar la actividad ?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Si",
                    denyButtonText: `Cancelar`,
                    confirmButtonColor: "#3085d6",
                    icon: "warning"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id_actividad = $(this).data('id_actividad');

                        $.ajax({
                            url: '<?php echo IP_SERVER ?>Actividad/eliminar_actividad',
                            type: 'POST',
                            data: {
                                id_actividad: id_actividad
                            },
                            success: function (response) {
                                // Manejar la respuesta del servidor aquí
                                Swal.fire({
                                    title: "Actividad eliminada!",
                                    icon: "success",
                                    showConfirmButton: false,
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            },
                            error: function (xhr, status, error) {
                                // Manejar errores aquí
                                Swal.fire("ooppps.. ocurrió un error !", "", "error");
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire("Cambios no aplicados", "", "info");
                    }
                });
            });

            $('.eliminar_criterio').click(function () {
                Swal.fire({
                    title: "Esta seguro de eliminar el criterio ?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Si",
                    denyButtonText: `Cancelar`,
                    confirmButtonColor: "#3085d6",
                    icon: "warning"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id_criterio = $(this).data('id_criterio');

                        $.ajax({
                            url: '<?php echo IP_SERVER ?>Criterio/eliminar_criterio',
                            type: 'POST',
                            data: {
                                id_criterio: id_criterio
                            },
                            success: function (response) {
                                // Manejar la respuesta del servidor aquí
                                Swal.fire({
                                    title: "Criterio eliminado!",
                                    icon: "success",
                                    showConfirmButton: false,
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            },
                            error: function (xhr, status, error) {
                                // Manejar errores aquí
                                Swal.fire("ooppps.. ocurrió un error !", "", "error");
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire("Cambios no aplicados", "", "info");
                    }
                });
            });

        });

        $(document).ready(function () {
            // Función para abrir el modal en modo de actualización
            $('.btn_editar_competencia').click(function () {
                var nombre = $(this).data('nombre_competencia');
                var descripcion = $(this).data('descripcion_competencia');
                var codigo = $(this).data('codigo_competencia');
                var año = $(this).data('codigo_año');
                var fecha = $(this).data('fecha');
                var fecha_vigencia = $(this).data('fecha_vigencia');
                var version = $(this).data('version');
                var id_competencia = $(this).data('id_competencia');

                $('.titulo_modal').text('Actualizar competencia');
                $('.guardar_competencia').text('Actualizar');
                $('#nombre').val(nombre);
                $('#descripcion').val(descripcion);
                $('#codigo').val(codigo);
                $('#año').val(año);
                $('#fecha').val(fecha);
                $('#fecha_vigencia').val(fecha_vigencia);
                $('#version').val(version);
                $('#id_competencia').val(id_competencia);

            });

            // Función para guardar la competencia (crear o actualizar)
            $('.guardar_competencia').click(function () {
                var competencia_id = $('#id_competencia').val();
                var tipo = competencia_id ? 'POST' : 'POST'; // POST para creación y actualización (asume que usas POST para ambos)
                var url = competencia_id ? '<?php echo IP_SERVER ?>Competencias/actualizar_competencia' : '<?php echo IP_SERVER ?>Competencias/crear_competencia';
                var mensaje_confirmacion = competencia_id ? "Esta seguro de editar la competencia ?" : "Esta seguro de crear la competencia ?";
                var mensaje_exito = competencia_id ? "Competencia actualizada!" : "Competencia creada!";
                console.log(competencia_id);

                Swal.fire({
                    title: mensaje_confirmacion,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Si",
                    denyButtonText: `Cancelar`,
                    confirmButtonColor: "#3085d6",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: tipo,
                            data: $('#crear_competencia_form').serialize(),
                            success: function (response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: mensaje_exito,
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire('Error', response.message, 'error');
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire('ooppps.. ocurrió un error !', '', 'error');
                            }
                        });
                    }
                });
            });

            $('.btn_editar_actividad').click(function () {
                var nombre = $(this).data('nombre_actividad');
                var id_actividad = $(this).data('id_actividad');
                var id_competencia = $(this).data('id_competencia');


                $('#id_competencia_actividad').val(id_competencia);
                $('#nombre_actividad').val(nombre);
                $('#id_actividad').val(id_actividad);
            });

            $('#crear_actividad').click(function () {
                var id_actividad = $('#id_actividad').val();
                var tipo = id_actividad ? 'POST' : 'POST';
                var url = id_actividad ? '<?php echo IP_SERVER ?>Actividad/actualizar_actividad' : '<?php echo IP_SERVER ?>Actividad/crear_actividad';
                var mensaje_confirmacion = id_actividad ? "Esta seguro de editar la actividad ?" : "Esta seguro de crear la actividad ?";
                var mensaje_exito = id_actividad ? "actividad actualizada!" : "actividad creada!";
                console.log(id_actividad);

                Swal.fire({
                    title: mensaje_confirmacion,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Si",
                    denyButtonText: `Cancelar`,
                    confirmButtonColor: "#3085d6",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: tipo,
                            data: $('#crear_actividad_form').serialize(),
                            success: function (response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: mensaje_exito,
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire('Error', response.message, 'error');
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire('ooppps.. ocurrió un error !', '', 'error');
                            }
                        });
                    }
                });
            });


            $('.btn_editar_criterio').click(function () {
                var nombre = $(this).data('nombre_criterio');
                var id_criterio = $(this).data('id_criterio');
                var id_actividad = $(this).data('id_actividad');

                $('#nombre_criterio').val(nombre);
                $('#id_criterio').val(id_criterio);
                $('#id_actividad_criterio').val(id_actividad);

            });


            $('#crear_criterio').click(function () {
                var id_criterio = $('#id_criterio').val();

                var tipo = id_criterio ? 'POST' : 'POST';
                var url = id_criterio ? '<?php echo IP_SERVER ?>Criterio/actualizar_criterio' : '<?php echo IP_SERVER ?>Criterio/crear_criterio';
                var mensaje_confirmacion = id_criterio ? "Esta seguro de actualizar el criterio ?" : "Esta seguro de crear el criterio ?";
                var mensaje_exito = id_criterio ? "criterio actualizado!" : "criterio creado!";

                Swal.fire({
                    title: mensaje_confirmacion,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Si",
                    denyButtonText: `Cancelar`,
                    confirmButtonColor: "#3085d6",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: tipo,
                            data: $('#crear_criterio_form').serialize(),
                            success: function (response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: mensaje_exito,
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire('Error', response.message, 'error');
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire('ooppps.. ocurrió un error !', '', 'error');
                            }
                        });
                    }
                });
            });

        });
    </script>

    <script>
        $(document).ready(function () {
            $('#crear_competencia').click(function () {
                Swal.fire({
                    title: "Esta seguro de crear la competencia ?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Si",
                    denyButtonText: `No cerrar`,
                    confirmButtonColor: "#3085d6",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        var formData = $('#crear_competencia_form').serialize();
                        $.ajax({
                            url: '<?php echo IP_SERVER ?>Competencias/crear_competencia',
                            type: 'POST',
                            data: formData,
                            success: function (response) {
                                // Manejar la respuesta del servidor aquí
                                Swal.fire({
                                    title: "Competencia creada!",
                                    icon: "success",
                                    showConfirmButton: false
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            },
                            error: function (xhr, status, error) {
                                // Manejar errores aquí
                                Swal.fire("ooppps.. ocurrió un error !", "", "error");
                            }
                        });


                    } else if (result.isDenied) {
                        Swal.fire("Cambios no aplicados", "", "info");
                    }
                });


            });


            $('#eliminar_competencia').click(function () {
                Swal.fire({
                    title: "Esta seguro de eliminar la competencia?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Si",
                    denyButtonText: `Cancelar`,
                    confirmButtonColor: "#3085d6",
                    icon: "warning"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id_competencia = $(this).data('id_competencia');
                        console.log(id_competencia);
                        $.ajax({
                            url: '<?php echo IP_SERVER ?>Competencias/eliminar_competencia',
                            type: 'POST',
                            data: {
                                competencia_id: id_competencia
                            },
                            success: function (response) {
                                // Manejar la respuesta del servidor aquí
                                Swal.fire({
                                    title: "Competencia eliminada!",
                                    icon: "success",
                                    showConfirmButton: false,
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            },
                            error: function (xhr, status, error) {
                                // Manejar errores aquí
                                Swal.fire("ooppps.. ocurrió un error !", "", "error");
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire("Cambios no aplicados", "", "info");
                    }
                });
            });

        });
    </script>

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
            $('.guardar_competencia_completa').click(function () {
                Swal.fire({
                    title: "Esta seguro de guardar la competencia ?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Si, guardar",
                    denyButtonText: `No, guardar`,
                    confirmButtonColor: "#3085d6",
                    icon: "question"
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        var competencia_id = $(this).data('id_competencia');

                        $.ajax({
                            url: '<?php echo IP_SERVER ?>Competencias/actualizar_estado',
                            type: 'POST',
                            data: {
                                estado: 1,
                                competencia_id: competencia_id
                            }, // Aquí se envían los datos
                            success: function (response) {
                                // Manejar la respuesta del servidor aquí
                                Swal.fire({
                                    title: "Competencia creada!",
                                    icon: "success",
                                    showConfirmButton: false
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            },
                            error: function (xhr, status, error) {
                                // Manejar errores aquí
                                Swal.fire("ooppps.. ocurrió un error !", "", "error");
                            }
                        });


                    } else if (result.isDenied) {
                        Swal.fire("Cambios no aplicados", "", "info");
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