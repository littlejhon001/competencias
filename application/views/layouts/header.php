<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>AULA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="copyright" content="CCS" />
    <meta name="revisit" content="5 days" />
    <meta name="Author" content="gffabio" />
    <meta name="medium" content="medium_type" />
    <meta name="Author Email" content="fabio.grandas@ccs.org.co" />
    <meta name="DC.creator" content="gffabio" />
    <meta name="DC.date" content="2020-04-22 010:00:00 AM" />
    <meta name="DC.language" content="ES" />
    <link rel="icon" type="image/png" href="<?php echo IP_SERVER ?>icon.png">
    <link rel="shortcut icon" href="<?php echo IP_SERVER ?>favicon.ico" title="CCS" id="CCS" type="image/x-icon" />

    <link href="<?php echo IP_SERVER ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo IP_SERVER ?>assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo IP_SERVER ?>assets/css/main.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Nucleo Icons -->
    <link href="<?php echo IP_SERVER ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?php echo IP_SERVER ?>assets/css/nucleo-svg.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- CSS Files -->

    <link id="pagestyle" href="<?php echo IP_SERVER ?>assets/css/material-dashboard.css" rel="stylesheet" />

    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

    <script src="<?php echo IP_SERVER ?>assets/jquery/jquery.slim.min.js"></script>
    <!-- <script src="<?php //  echo IP_SERVER           ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <script src="<?php echo IP_SERVER ?>assets/js/material-dashboard.min.js"></script>
    <script src="<?php echo IP_SERVER ?>assets/js/core/popper.min.js"></script>
    <script src="<?php echo IP_SERVER ?>assets/js/core/bootstrap.min.js"></script>
    <script src="<?php echo IP_SERVER ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?php echo IP_SERVER ?>assets/js/plugins/smooth-scrollbar.min.js"></script>


</head>

<!DOCTYPE html>



<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs z- border-radius-xl border my-3 fixed-start ms-3 shadow-sm z-3 bg-ppal  animate__animated animate__fadeInLeft"
    id="sidenav-main">

    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand  text-center mb-3" href="" target="_blank">
            <img src="<?php echo IP_SERVER ?>assets/img/logoAula.png" class="navbar-brand-img  h-100" alt="main_logo">
        </a>
    </div>

    <hr class="horizontal dark mt-4 mb-2">

    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link text-dark " href="<?php echo IP_SERVER ?>Home">
                    <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Inicio</span>
                </a>
            </li>

            <?php if ($this->session->userdata('user_data')->Rol_ID == 1 || $this->session->userdata('user_data')->Rol_ID == 2 || $this->session->userdata('user_data')->Rol_ID == 3) { ?>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="<?php echo IP_SERVER ?>Usuarios">

                        <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <span class="nav-link-text ms-1">Usuarios</span>
                    </a>
                </li>
            <?php } ?>


            <?php if ($this->session->userdata('user_data')->Rol_ID == 1 || $this->session->userdata('user_data')->Rol_ID == 2 || $this->session->userdata('user_data')->Rol_ID == 3) { ?>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="<?php echo IP_SERVER?>Competencias">

                        <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>

                        <span class="nav-link-text ms-1">Competencias</span>
                    </a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="./billing.html">

                        <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">mis competencias</span>
                    </a>
                </li>
            <?php } ?>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">Cuenta
                </h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark " href="./profile.html">

                    <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>

                    <span class="nav-link-text ms-1">Perfil</span>
                </a>
            </li>

            <hr class="horizontal dark mt-4 mb-2">
            <li class="nav-item">
                <a class="nav-link text-info " href="<?php echo IP_SERVER ?>Login/logout">

                    <div class="text-warnning text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>

                    <span class="nav-link-text ms-1">Salir</span>
                </a>
            </li>


        </ul>
    </div>


</aside>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    flashdata = <?php echo json_encode($this->session->flashdata())?>;
        if(!Array.isArray(flashdata)){
            if(flashdata.success == true){
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    timer: 3000,
                    timerProgressBar: true,
                    title: flashdata.message,
                    icon: "success",
                    showConfirmButton: false,
                })
            }else{
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    timer: 3000,
                    timerProgressBar: true,
                    title: flashdata.message,
                    icon: "error",
                    showConfirmButton: false,
                })
            }
        }
</script>