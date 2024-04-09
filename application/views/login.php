<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">


<link href="<?php echo IP_SERVER ?>assets/css/login.css" rel="stylesheet" type="text/css">


<div class="container-fluid login-container">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 d-none d-md-flex bg-image animate__fadeIn animate__animated">
            <img class="img_bg  " src="<?php echo IP_SERVER ?>assets/img/competencias.jpg" alt="">
        </div>
        <!-- The content half -->
        <div class="col-md-6 bg-login animate__fadeIn animate__animated">
            <div class="login d-flex align-items-center py-5">
                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <img class="" src="<?php echo IP_SERVER ?>/assets/img/logoAula.png" width="500px" alt="">
                            <h3 class="display-4 color-text">Competencias</h3>
                            <p class=" mb-4 color-text">Inicia sesión</p>
                            <form id="ingresar" method="post">
                                <div class="form-group mb-3">
                                    <input id="inputEmail" type="email" placeholder="usuario" autofocus=""
                                        class="form-control rounded-pill border-0 shadow-sm px-4" name="email">
                                </div>

                                <div class="form-group mb-3 position-relative">
                                    <input id="inputPassword" type="password" placeholder="Contraseña"
                                        class="form-control rounded-pill border-0 shadow-sm px-4 text-primary pr-5"
                                        name="contrasena">
                                    <button
                                        class="btn border-0 toggle-password position-absolute end-0 top-50 translate-middle-y"
                                        type="button">
                                        <i class="bi bi-eye-slash-fill" aria-hidden="true"></i>
                                    </button>
                                </div>

                                <button type="submit"
                                    class="btn btn-primary btn-block text-uppercase my-2 rounded-pill w-100 shadow-sm btn-bg">Ingresar</button>
                                <div class="text-center d-flex justify-content-center mt-2">
                                    <p class="">¿Olvidaste tu contraseña? <a href="" class=" ">
                                            <u>Contacto</u></a></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>



<script src="<?php echo IP_SERVER ?>assets/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
    $(document).ready(function () {
        $('#ingresar').submit(function (event) {
            event.preventDefault();

            // Obtener valores de los campos de email y contraseña
            var email = $('#inputEmail').val();
            var contrasena = $('#inputPassword').val();

            // Verificar que el campo de email no esté vacío
            if (email == '') {
                Swal.fire({
                    position: "top-end",
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor ingrese su correo electrónico.',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
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
                return;
            }
            // Verificar que el campo de email no esté vacío
            if (contrasena == '') {
                Swal.fire({
                    position: "top-end",
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor ingrese su contraseña.',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
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
                return;
            }

            // Verificar que el campo de contraseña no esté vacío


            // Si los campos no están vacíos, proceder con la solicitud AJAX
            $.post('<?php echo IP_SERVER ?>Login/procesar',
                $(this).serialize(),
                function (result) {
                    if (result.success == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: result.msg,
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            location.assign('<?php echo IP_SERVER ?>Home');
                        });
                    } else {
                        let errorMessage = Object.values(result.msg).join('');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: errorMessage,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 5000
                        });
                    }
                }
            );
        });
    });




    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('.toggle-password');
        const passwordField = document.querySelector('#inputPassword');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash-fill');
        });
    });


</script>