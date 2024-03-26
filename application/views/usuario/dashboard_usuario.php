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
                    <!-- <pre><?php // echo print_r($this->session->userdata('user_data'), true)                        ?></pre> -->


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
                                    <div class="d-flex flex-column h-100">
                                        <h3 class="font-weight-bolder mb-0">Mis competencias</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PLANTILLA PARA CADA ACTIVIDAD -->
                    <div id="actividad" class="d-none">
                        <div class="card bg-light bg-opacity-50 bg-gradient my-3 p-3">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-12 col-md-8 align-middle">
                                    <h6 class="m-0">Ejemplo</h6>
                                </div>
                                <div class="col-12 col-md-4 text-center">
                                    <button class="btn btn-primary consulta_criterios" data-bs-toggle="modal"
                                        data-bs-target="#evaluacion" data-row="">Comenzar evaluación</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- --- -->
                    <!-- TARJETA DE VACÍO -->
                    <div id="vacio" class="d-none">
                        <div class="card bg-light bg-opacity-50 bg-gradient my-3 p-3">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-12 align-middle text-center">
                                    <h6 class="m-0">No hay registros.</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- --- -->
                    <?php foreach ($competencias_asignadas as $row) { ?>
                    <div>
                        <div class="px-4 py-3 ">
                            <div class="p-4 card-competencia rounded shadow-sm ">
                                <h6 class="mb-0">
                                    <?php echo $row->nombre ?>
                                </h6>
                                <p class="my-2">
                                    <?php echo $row->descripcion ?>
                                </p>
                                <button class="consultar_detalle_competencia text-center btn btn-success"
                                    data-id="<?php echo $row->id?>">Ver más..</button>
                                <div class="extender" style="display:none;">
                                    <h5 class="mt-2">Actividades Clave</h5>
                                    <div class="actividades">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="modal modal-lg fade" id="evaluacion" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <input name="id_usuario" type="hidden" value="">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-none" id="plantilla_criterios">
                            <input name="id_criterio_competencia[]" type="hidden" value="">
                            <div class="card">
                                <div class="card-body">
                                    <label class="m-0"><b>Texto label de ejemplo</b></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="resultado" disabled
                                            value="1" id="resultado1">
                                        <label class="form-check-label" for="resultado1">
                                            Sí
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="resultado" disabled value="2"
                                            id="resultado2">
                                        <label class="form-check-label" for="resultado2">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="loader" class="d-none">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div id="loader-lg" class="d-none">
            <div class="text-center">
                <div class="spinner-border spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
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

    <script src="<?php echo IP_SERVER ?>assets/jquery/jquery.min.js"></script>


    <script>
    $(document).ready(function() {
        plantilla_actividad = $('#actividad').clone()
        tarjeta_vacio = $('#vacio').clone()
        $('#actividad').remove()
        $('#vacio').remove()
    })
    $('.consultar_detalle_competencia').click(function(){
        elemento_actual = $(this);
        listado_actividades = elemento_actual.next('.extender').find('.actividades');
        if (listado_actividades.children().length) {
            elemento_actual.next('.extender').toggle("fast")
        } else {
            elemento_actual.append($('#loader').html())
            elemento_actual.prop("disabled", true)
            listado_actividades.empty()
            $.get("<?php echo IP_SERVER?>competencias/listado_actividades/" + $(this).data('id'), function(
                respuesta) {
                elemento_actual.find('.spinner-border').remove()
                elemento_actual.prop("disabled", false)
                if (respuesta.success == true) {
                    if (respuesta.actividades.length > 0) {
                        $.each(respuesta.actividades, function(indice, valor) {
                            actividad = plantilla_actividad.clone()
                            boton = actividad.find('.consulta_criterios')
                            if (valor.evaluada == 1) {
                                boton.text("ver mis resultados")
                            } else {
                                if (valor.criterios > 0) {
                                    boton.text("criterios de evaluación")
                                    boton.removeClass('btn-primary')
                                    boton.addClass('btn-secondary')

                                } else {
                                    boton.prop("disabled", true)
                                    boton.removeClass('btn-primary')
                                    boton.text("sin criterios de evaluación")
                                }
                            }
                            actividad.find('h6').text(valor.nombre)
                            actividad.removeClass('d-none')
                            boton.data('row',{ id: valor.id, nombre: valor.nombre, evaluada: valor.evaluada})
                            listado_actividades.append(actividad)
                        })
                    } else {
                        listado_actividades.append(tarjeta_vacio.html())
                    }
                    elemento_actual.next('.extender').toggle("fast")
                }
            })
        }
    });

    // <!-- LISTA DE CRITERIOS EN EL MODAL -->

    input_criterio = $('#plantilla_criterios').clone()
    $('.extender').on('click','.consulta_criterios',function() {
        boton_actividad = $(this);
        $('#evaluacion').find('.modal-title').text('Criterios para: '+boton_actividad.data('row').nombre);
        $('#evaluacion').find('.modal-body').text('');
        $('#evaluacion').find('.modal-body').append($('#loader-lg').html());
        consultar_criterios(boton_actividad.data('row').id).then((respuesta) => {
            $('#evaluacion').find('.modal-body').text('');
            if (!respuesta.error) {
                if (respuesta.success == true) {
                    criterios = respuesta.criterios
                    $.each(criterios, (index,criterio) => {
                        input = input_criterio.clone()
                        input.find('label b').text(criterio.nombre)
                        if(boton_actividad.data('row').evaluada != 1){
                            input.find('.form-check').remove()
                            input.find('.card-body').addClass('bg-light')
                        }else{
                            input.find(`input[type="radio"][value="${criterio.resultado}"]`).attr('checked',true)
                        }
                        input.find('input[type="hidden"]').attr('value',criterio.id)
                        input.find('input[type="radio"]').attr('name','resultado['+index+']')
                        $('#evaluacion').find('.modal-body').append(`<p>${input.html()}</p>`)
                    })
                }
            } else {
                alert(respuesta.error)
            }
        })
    })
    function consultar_criterios(id_actividad) {
        return $.get(`<?php echo IP_SERVER ?>usuarios/criterios_por_cargo/<?php echo $this->session->userdata('user_data')->id_cargo?>/${id_actividad}/<?php echo $this->session->userdata('user_data')->id?>`)
    }
    </script>

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