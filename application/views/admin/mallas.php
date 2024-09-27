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
                                    <h3 class="text-white  ps-4 mt-2">Áreas</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="accordion " id="accordionExample">
                                <?php $first = false; ?>
                                <?php foreach ($mallas as $area): ?>
                                    <div class="accordion-item ">
                                        <h2 class="accordion-header bg-gray-200 ps-3">
                                            <button
                                                class="accordion-button  font-weight-bold <?php echo $first ? '' : 'collapsed'; ?>"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse<?php echo $area->id; ?>"
                                                aria-expanded="<?php echo $first ? 'true' : 'false'; ?>"
                                                aria-controls="collapse<?php echo $area->id; ?>">
                                                <?php echo $area->nombre; ?>
                                            </button>
                                        </h2>
                                        <div id="collapse<?php echo $area->id; ?>"
                                            class="accordion-collapse collapse <?php echo $first ? 'show' : ''; ?>"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p class=" mb-2">
                                                    Cargos
                                                </p>
                                                <?php foreach ($area->cargos as $cargo) { ?>
                                                    <ul>
                                                        <li>
                                                            <a class="button-mallas m-1"
                                                                href="<?php echo IP_SERVER . 'mallas/cargo_cursos/' . $cargo->id ?>">
                                                                <?php echo $cargo->nombre; ?>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $first = false; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->



        </div>
    </main>


    <script>
        $(document).ready(function () {
            $('#exampleModal').on('show.bs.modal', function (event) {
                // Obtenemos el botón que disparó el modal
                var button = $(event.relatedTarget);

                // Extraemos el nombre del cargo
                var nombreCargo = button.data('nombre-cargo');
                var cursos = [];

                // Iteramos sobre los atributos del botón usando un bucle manual
                $.each(button.data(), function (key, value) {
                    if (key.startsWith('cursoNombre')) {
                        var cursoId = key.replace('cursoNombre', '');
                        var cursoNombre = value;
                        cursos.push({
                            id: cursoId,
                            nombre: cursoNombre
                        });
                    }
                });

                // Actualizamos el título del modal con el nombre del cargo
                var modal = $(this);
                modal.find('.modal-title').text('Cursos para el cargo: ' + nombreCargo);

                // Limpiamos el contenido del modal-body
                modal.find('.modal-body').empty();

                // Llenamos los detalles de los cursos
                cursos.forEach(function (curso) {
                    modal.find('.modal-body').append('<p>Curso: ' + curso.nombre + ' (ID: ' + curso
                        .id + ')</p>');
                });
            });
        });
    </script>




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
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