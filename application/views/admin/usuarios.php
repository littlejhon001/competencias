<body class="g-sidenav-show  bg-gray-100 animate__fadeIn animate__animated">
    <main class="main-content border-radius-lg ">
        <!-- Navbar -->


        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <!-- <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">index</li>
          </ol> -->
                    <!-- <pre><?php // echo print_r($this->session->userdata('user_data'), true)                    ?></pre> -->


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

        <div class="container-fluid py-2">
            <h2>Aula competencias</h2>
            <div class="row">
                <div class="col-lg-12 position-relative z-index-2">
                    <div class="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column h-100">
                                        <h2 class="font-weight-bolder my-3 mb-4">
                                            <?php echo ($this->session->userdata('user_data')->Rol_ID == 1) ? ' Vista general de usuarios' : 'Grupos de usuarios' ?>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <?php if (($this->session->userdata('user_data')->Rol_ID == 1)) { ?>
                            <div class="col-md-4 col-sm-5">
                                <div class="card card-users  mb-2">
                                    <a href="<?php echo IP_SERVER ?>Usuarios/detalle_usuarios" class="">
                                        <div class="card-header rounded-4 p-3 pt-2">
                                            <div
                                                class="icon icon-lg icon-shape bs-orange shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                                <i class=" material-icons  bi bi-people-fill"></i>
                                            </div>
                                            <div class="text-end pt-1">
                                                <a href="<?php echo IP_SERVER ?>Usuarios/detalle_usuarios">
                                                    <p class="text-sm mb-0 text-capitalize">Usuarios registrados</p>
                                                </a>
                                                <h4 class="mb-0"></h4>
                                            </div>
                                        </div>

                                        <hr class="dark horizontal my-0">
                                        <div class="card-footer p-3">
                                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                                </span>Examinar lista de usuarios</p>
                                        </div>
                                    </a>
                                </div>
                            </div>



                            <div class="col-lg-4 col-sm-5 mt-sm-0 mt-4">
                                <div class="card card-users mb-2">
                                    <a href="<?php echo IP_SERVER ?>Usuarios/asignar">
                                        <div class="card-header p-3 pt-2 bg-transparent">
                                            <div
                                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                                <i class="material-icons  bi bi-person-badge"></i>
                                            </div>
                                            <div class="text-end pt-1">
                                                <p class="text-sm mb-0 text-capitalize ">Asignar competencias y evaluadores
                                                </p>
                                                <h4 class="mb-0 "></h4>
                                            </div>
                                        </div>

                                        <hr class="horizontal my-0 dark">
                                        <div class="card-footer p-3">
                                            <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+1%
                                                </span>than yesterday</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php } else {
                            foreach ($grupos as $grupo) { ?>
                                <div class="col-lg-3  col-sm-5 mt-sm-0 my-4">
                                    <div class="card card-users mb-2">
                                        <a href="<?php echo IP_SERVER ?>Usuarios/asignar/<?php echo encrypt($grupo->id_grupo)?>">
                                            <div class="card-header p-3 pt-2 bg-transparent">
                                                <div
                                                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                                    <i class="material-icons  bi bi-person-badge"></i>
                                                </div>
                                                <div class="text-end pt-1">
                                                    <h2>
                                                        Grupo :  <?php echo $grupo->id_grupo ?>
                                                    </h2>
                                                    <p class="text-sm mb-0 text-capitalize ">
                                                        Asignar competencias y evaluadores
                                                    </p>
                                                    <h4 class="mb-0 "></h4>
                                                </div>
                                            </div>
                                            <hr class="horizontal my-0 dark">
                                            <div class="card-footer p-3">
                                                <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">
                                                        cantidad: <?php echo $grupo->num_usuarios ?>
                                                    </span> </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
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
                    <h5 class="mt-3 mb-0">Preferencias</h5>

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

            </div>
        </div>
    </div>
    </div>
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




</body>

</html>