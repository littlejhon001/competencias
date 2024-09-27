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
            <h2>Bienvenidos '' </h2>
            <div class="row">
                <!-- <h2 class="font-weight-bolder my-3 mb-4">Asignar evaluadores a
                    <?php // echo $area                            ?>
                </h2> -->
                <p>
                    "¿Conoces nuestras mallas de desarrollo? Son tu roadmap para crecer profesionalmente dentro
                    de la empresa. Encontrarás las capacitaciones, cursos y proyectos que te permitirán adquirir
                    las habilidades necesarias para alcanzar tus metas. ¡Explóralas y traza tu ruta hacia el
                    éxito! Para acceder a ellas, consulta aquí las mallas de tu cargo y los demás"
                </p>
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bs-orange shadow-primary border-radius-lg pt-3 pb-3">
                                <div class="d-flex  ">
                                    <h3 class="text-white  ps-4 mt-2">Consulta y filtra tu malla</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-6">
                                    <select class="form-select buscar_cargos" aria-label="Default select example">
                                        <option selected>Selecciona el Area</option>
                                        <?php foreach ($mallas as $area) { ?>
                                            <option value="<?php echo $area->id ?>"><?php echo $area->nombre ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-select buscar_cursos" aria-label="Default select example">
                                        <option disabled selected>Seleccione el cargo</option>
                                    </select>
                                </div>

                                <div class="col-2">
                                    <button class="btn-clear me-3 limpiar_filtro">
                                        limpiar filtros
                                        <img width="16" height="16" src="https://img.icons8.com/ios/50/broom.png" alt="broom"/>
                                    </button>
                                </div>

                                <div class="row mostrar_cursos mt-3">
                                </div>



                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border text-info mt-3 " style="display:none;" role="status"
                                    id="loader">
                                    <span class="visually-hidden"></span>
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
            $('.limpiar_filtro').click(function () {
                $('.buscar_cargos').val('Selecciona el Area');
                $('.buscar_cursos').val('Selecciona el cargo');
                $('.buscar_cargos').prop('disabled', false);
                $('.buscar_cursos').prop('disabled', false);
                $('.mostrar_cursos').empty();
            });
            var url = "<?php echo IP_SERVER ?>";
            $('.buscar_cargos').change(function () {
                var id_area = $(this).val();
                $.ajax({
                    url: url + "mallas/get_cargos",
                    type: "POST",
                    data: {
                        id_area: id_area
                    },
                    beforeSend: function () {
                        // Mostrar el loader antes de enviar la solicitud
                        $('#loader').show();
                        $('.buscar_cargos').prop('disabled', true);
                    },
                    success: function (response) {

                        var cargos = JSON.parse(response);
                        var html = '<option selected>Selecciona el Cargo</option>';
                        cargos.forEach(cargo => {
                            html += '<option value="' + cargo.id_cargo + '">' + cargo.nombre_cargo + '</option>';
                        });
                        $('.buscar_cursos').html(html);
                    },
                    complete: function () {
                        // Ocultar el loader después de completar la solicitud
                        $('#loader').hide();
                    }
                });
            });

            $('.buscar_cursos').change(function () {
                var id_cargo = $(this).val();
                $.ajax({
                    url: url + "mallas/get_cursos_usuario",
                    type: "POST",
                    data: {
                        id_cargo: id_cargo
                    },
                    beforeSend: function () {
                        // Mostrar el loader antes de enviar la solicitud
                        $('#loader').show();
                        $('.buscar_cursos').prop('disabled', true);

                    },
                    success: function (response) {
                        $('.mostrar_cursos').empty();
                        var cursos = JSON.parse(response);
                        var html = '';
                        cursos.forEach(curso => {
                            html += `
                            <div class="col-3 mt-1">
                                <div class="card m-1">
                                    <div class="card-body">
                                        <h5 class="card-title">${curso.nombre_curso}</h5>
                                        <p class="card-text">${curso.categoria_curso}</p>
                                        <a href="${curso.url_curso}" target="_blank" class="btn btn-primary">Ir al curso</a>
                                    </div>
                                </div>
                            </div>
                        `;
                        });
                        $('.mostrar_cursos').html(html);
                    },
                    complete: function () {
                        // Ocultar el loader después de completar la solicitud
                        $('#loader').hide();
                    }
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