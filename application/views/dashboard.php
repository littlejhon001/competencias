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
                <div class=" position-relative z-index-2">
                    <div class="card card-plain mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Usuarios que completaron competencias</h5>
                                            <p class="card-text">Usuarios que completaron competencias por año
                                            </p>

                                        </div>
                                        <div class="my-3" style="">
                                            <canvas id="graficoUsuariosPorAnio"></canvas>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Total usuarios y evaluadores</h5>
                                            <p class="card-text">
                                                <?php //  echo ?>
                                            </p>

                                        </div>
                                        <div class="my-3 w-50 text-center" style="">
                                            <canvas id="graficoTotalUsuarios"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 my-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Usuarios con competencia realizada</h5>
                                        </div>
                                        <div class="my-3" style="">
                                            <canvas id="graficoUsuarios_competencia_completa"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
        </div>
    </main>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Gráfico de Usuarios por Año
            var ctx1 = document.getElementById('graficoUsuariosPorAnio').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: <?= json_encode(array_keys($datos['usuarios_por_anio'])) ?>, // Años
                    datasets: [{
                        label: 'Total de Usuarios por Año',
                        data: <?= json_encode(array_values($datos['usuarios_por_anio'])) ?>, // Datos
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });

            // Gráfico de Total de Usuarios y Evaluadores
            var ctx2 = document.getElementById('graficoTotalUsuarios').getContext('2d');
            new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: ['Estudiantes', 'Evaluadores'], // Etiquetas
                    datasets: [{
                        label: 'Total de Usuarios',
                        data: [<?= $datos['usuarios_estudiantes'] ?>, <?= $datos['usuarios_evaluadores'] ?>], // Datos
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });

            var ctx3 = document.getElementById('graficoUsuarios_competencia_completa').getContext('2d');
            new Chart(ctx3, {
                type: 'bar', // Puedes cambiar el tipo de gráfico si es necesario
                data: {
                    labels: ['Usuarios con Competencia Completada'], // Etiqueta única
                    datasets: [{
                        label: 'Total de Usuarios con Competencia Completada',
                        data: [<?= $datos['usuarios_competencia_completada'] ?>], // Datos
                        backgroundColor: 'rgba(153, 102, 255, 0.6)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });
        });
    </script>


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


    <!--Load the AJAX API-->



</body>

</html>