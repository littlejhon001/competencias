<!DOCTYPE html>
<html lang="en">





<body class="g-sidenav-show  bg-gray-200 animate__fadeIn animate__animated">

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <!-- <ol class="breadcrumb  mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
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
                                    <h3 class="text-white  ps-4 mt-2">
                                        Cursos para el cargo: <?php echo $cargo->nombre ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($cursos as $curso) { ?>
                                    <div class="col-3">


                                        <div class="card border mb-3" style="max-width: 18rem; height:auto;">
                                            <div class="card-header card-title  border">
                                                <h4 class="fs-6">
                                                    <?php echo $curso->nombre_curso ?>
                                                </h4>
                                            </div>
                                            <div class="card-body text">
                                                <h6 class=""> <?php echo $curso->categoria_curso ?></h6>
                                                <a class="text-info" href="<?php echo $curso->url_curso ?>">
                                                    <i class="bi bi-link-45deg"></i>
                                                    <?php echo $curso->url_curso ?>
                                                </a>
                                            </div>
                                            <div class="card-footer  border">
                                                <div class="d-flex justify-content-end ">
                                                    <button href="#" class="btn bg-warning btn-editar-curso"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                        data-id="<?php echo $curso->id_curso ?>"
                                                        data-nombre="<?php echo $curso->nombre_curso ?>"
                                                        data-url="<?php echo $curso->url_curso ?>"
                                                        data-categoria="<?php echo $curso->categoria_curso ?>">
                                                        <i class="text-white bi bi-pencil-square"></i>
                                                    </button>
                                                    <button href="#" class="ms-1 btn bg-danger eliminar_curso" data-id="<?php echo $curso->id_curso ?>"><i
                                                            class="text-white bi bi-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar curso</h1>
                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo IP_SERVER ?>mallas/editar_curso" id="form_editar_curso">
                            <div>
                                <input type="hidden" name="" id="id_curso">
                                <label for="nombre">Nombre del curso</label>
                                <input type="text" class="form-control" id="nombre_curso" name="nombre">
                                <label for="nombre">Categoría</label>
                                <input type="text" class="form-control" id="categoria" name="categoria">
                                <label for="nombre">Url del curso</label>
                                <input type="text" class="form-control" id="url_curso" name="url_curso">

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-guardar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>


        </div>
    </main>

    <script>
        $(document).ready(function () {
            $('.btn-editar-curso').click(function () {
                var id = $(this).data('id');
                var nombre = $(this).data('nombre');
                var url = $(this).data('url');
                var categoria = $(this).data('categoria');

                $('#id_curso').val(id);
                $('#nombre_curso').val(nombre);
                $('#url_curso').val(url);
                $('#categoria').val(categoria);
            });


            $('.btn-guardar').click(function () {
                var id = $('#id_curso').val();
                var nombre = $('#nombre_curso').val();
                var url = $('#url_curso').val();
                var categoria = $('#categoria').val();
                var url_form = $('#form_editar_curso').attr('action');
                $.ajax({
                    url: url_form,
                    type: 'POST',
                    data: {
                        id: id,
                        nombre: nombre,
                        url: url,
                        categoria: categoria
                    },
                    success: function (response) {
                        response = JSON.parse(response); // Asegúrate de que la respuesta sea un objeto JSON

                        if (response.status == '1') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                });
            });


            $('.eliminar_curso').click(function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: '¿Estás seguro de eliminar este curso?',
                    text: "No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?php echo IP_SERVER ?>mallas/eliminar_curso',
                            type: 'POST',
                            data: {
                                id: id
                            },
                            success: function (response) {
                                response = JSON.parse(response); // Asegúrate de que la respuesta sea un objeto JSON

                                if (response.status == '1') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1500);
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            }
                        });
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