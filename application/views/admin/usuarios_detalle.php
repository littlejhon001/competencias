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
                    <!-- <pre><?php // echo print_r($user_data, true)                                                                ?></pre> -->


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
                                                <img src="./assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="./assets/img/small-logos/logo-spotify.svg"
                                                    class="avatar avatar-sm bg-gradient-dark  me-3 ">
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
                <h2 class="font-weight-bolder my-3 mb-4">Vista general de usuarios</h2>
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bs-orange shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex ">
                                    <h6 class="text-white text-capitalize ps-5 mt-2">Lista de usuarios</h6>
                                    <div class="ms-auto">
                                        <?php if ($user_data->Rol_ID == 1) { ?>
                                            <button type="button" class="me-3 btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">
                                                Agregar nuevo usuario <i class="fs-6 bi bi-plus-circle"></i>
                                            </button>
                                            <button type="button" class="me-3 btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#importar">
                                                Importar usuarios masivamente<i class="fs-6 bi bi-plus-circle"></i>
                                            </button>
                                        <?php } else { ?>
                                            <a href="<?php echo IP_SERVER ?>Usuarios/asignar" class="me-3 btn btn-success">
                                                asignar evaluador <i class="fs-6 bi bi-person-plus-fill"></i>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">

                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nombre</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Apellido</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Cargo</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Asignado</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Acciones</th>
                                            <!-- <th class="text-secondary opacity-7"></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--
                                        <pre><?php // echo print_r($usuarios, true)                             ?></pre> -->

                                        <?php foreach ($usuarios as $row) {
                                            if ($row->Rol_ID == 4) {
                                                ?>
                                                <tr
                                                    class="<?php echo ($row->id_evaluador != "") ? 'bg-asignado' : 'bg-sin_asignar'; ?>">
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <i class="me-2 bi bi-person-circle"></i>
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
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
                                                        <?php echo $row->cargo ?>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <?php echo ($row->id_evaluador != "") ? '<i class="bi bi-check-circle text-success"></i>' : '<i class="bi bi-info-circle-fill text-warning"></i>'; ?>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <button class="border rounded bg-primary" type="button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ver_mas<?php echo $row->id ?>">
                                                            <i class="text-light bi bi-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="ver_mas<?php echo $row->id ?>" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Información
                                                                    del usuario
                                                                </h1>
                                                                <button type="button" class="btn-close bg-danger"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4>
                                                                    Nombres y apellidos usuario:
                                                                </h4>
                                                                <h4>
                                                                    <?php echo $row->nombre . ' ' . $row->apellido ?>
                                                                </h4>
                                                                <div class="text-md">
                                                                    <h6>
                                                                        Correo:
                                                                        <a href="mailto:<?php echo $row->email ?>">
                                                                            <?php echo $row->email ?>
                                                                        </a>
                                                                    </h6>
                                                                    <h6 class="text-md">
                                                                        Cargo:
                                                                        <?php echo $row->cargo ?>
                                                                    </h6>

                                                                    <?php
                                                                    // Buscar el nombre del evaluador basado en el id_evaluador
                                                                    $nombre_evaluador = "No asignado";
                                                                    foreach ($usuarios as $usuario) {
                                                                        if ($usuario->id == $row->id_evaluador) {
                                                                            $nombre_evaluador = $usuario->nombre . ' ' . $usuario->apellido;
                                                                            break; // Salir del bucle una vez encontrado el nombre del evaluador
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <h6
                                                                        class="text-md <?php echo ($nombre_evaluador != "No asignado") ? 'bg-asignado' : 'bg-sin_asignar'; ?>">
                                                                        Evaluador asignado:
                                                                        <?php echo $nombre_evaluador; ?>
                                                                    </h6>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer border-0">
                                                                <button type="button"
                                                                    class="btn btn-primary m-0">Guardar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </main>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar nuevo usuario</h1>
                    <button type="button" class="bg-danger btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="cargo" name="email" class="form-label">Numero de documento</label>
                            <input type="number" class="form-control ps-2" id="cargo" placeholder="Numero de documento">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre</label>
                            <input type="text" placeholder="Nombre" class="form-control ps-2" id=""
                                name="Nombre_usuario" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Apellido</label>
                            <input type="text" placeholder="Apellido" class="form-control ps-2" id=""
                                name="Nombre_usuario" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="email" name="email" class="form-label">Correo</label>
                            <input type="email" class="form-control ps-2" id="email" placeholder="Correo">
                        </div>
                        <div class="mb-3">
                            <label for="cargo" name="email" class="form-label">Cargo</label>
                            <input type="cargo" class="form-control ps-2" id="cargo" placeholder="Cargo">
                        </div>
                        <div class="mb-3">
                            <label for="cargo" name="email" class="form-label">Areas</label>
                            <select class="form-select ps-2" aria-label="Default select example">
                                <option selected disabled>Seleccione ---</option>
                                <?php foreach ($areas as $row) { ?>
                                    <option value="1"><?php echo $row->nombre?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cargo" name="email" class="form-label">Seleccione el tipo de usuario</label>
                            <select class="form-select ps-2" aria-label="Default select example">
                                <option selected disabled>Seleccione ---</option>
                                <option value="1">Gestor de evaluador</option>
                                <option value="2">Evaluador</option>
                                <option value="3">Usuario</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                            <button type="button" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Importar usuarios</h1>
                    <button type="button" class="bg-danger btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="file" class="form-control p-3" id="inputGroupFile04"
                            aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                            <button type="button" class="btn btn-success">Cargar</button>
                        </div>
                    </form>
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