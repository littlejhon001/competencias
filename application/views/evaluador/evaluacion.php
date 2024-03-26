<!-- <pre><?php  // echo  print_r($resultado, true)       ?> </pre> -->
<div class="row py-5">
    <div class="row">
        <div class="col-md-2  col-2">

        </div>
        <div class="col-md-9 col-9 mx-auto ">
            <!-- Profile widget -->
            <div class=" shadow  mb-4 rounded overflow-hidden">
                <div class=" d-flex border bg-perfil justify-content-center cover">
                    <div class="media text-center mt-2  profile-head">
                        <div class="profile ">
                            <img src="<?php echo IP_SERVER ?>assets/img/avatar.webp" alt="..." width="130"
                                class="rounded-circle shadow  mb-2 border img-thumbnail">
                        </div>
                        <div class="media-body mb-2">
                            <h4 class="">
                                Nombre:

                                <?php echo $usuarios->nombre . ' ' . $usuarios->apellido ?>
                            </h4>
                            <p class=" m-0 p-0 ">
                                Cargo:
                                <?php echo $usuarios->cargo ?>
                            </p>
                            <p class=" small m-0 p-0">
                                Correo:
                                <?php echo $usuarios->email ?>
                            </p>
                        </div>
                    </div>
                </div>
                <h5 class="mb-2 ms-2 mt-3">Evaluar competencia al colaborador:
                    <?php echo $usuarios->nombre . ' ' . $usuarios->apellido ?>
                </h5>
                <div class="px-4 py-3">
                    <div class="p-4 card-competencia  rounded shadow-sm ">
                        <h6 class="mb-0">
                            <?php echo $competencia->nombre ?>
                        </h6>
                        <p class="my-2">
                            <?php echo $competencia->descripcion ?>
                        </p>
                        <h5 class="mt-2">
                            Actividades clave
                        </h5>
                        <?php foreach ($actividades_clave as $row) { ?>

                            <div class="d-flex m-2 ">
                                <h6 class="mt-1">
                                    <?php echo $row->nombre ?>
                                </h6>
                                <div class="ms-auto">

                                    <?php if (empty ($row->evaluada)) { ?>
                                        <a type="button" class="btn btn-primary consulta_criterios" data-bs-toggle="modal"
                                            data-bs-target="#evaluacion" data-row='<?php echo json_encode($row); ?>'>
                                            Comenzar evaluación
                                        </a>
                                    <?php } else { ?>
                                        <a type="button" class="btn btn-success consulta_criterios" data-bs-toggle="modal"
                                            data-bs-target="#evaluacion" data-row='<?php echo json_encode($row); ?>'>
                                            Ver resultados
                                        </a>
                                    <?php } ?>
                                </div>

                            </div>
                            <!-- Modal -->

                        <?php } ?>

                        <div class="modal modal-lg fade" id="evaluacion" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="form-evaluacion" novalidate class="needs-validation"
                                        action="<?php echo IP_SERVER ?>usuarios/guardar_evaluacion" method="post">
                                        <input name="id_usuario" type="hidden" value="<?php echo $usuarios->id ?>">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                <?php echo $row->nombre ?>
                                            </h1>
                                            <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-none" id="plantilla_criterios">
                                                <input name="id_criterio_competencia[]" type="hidden" value="">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label><b>Texto label de ejemplo</b></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="resultado" required value="1" id="resultado1">
                                                            <label class="form-check-label" for="resultado1">
                                                                Sí
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="resultado" value="2" id="resultado2">
                                                            <label class="form-check-label" for="resultado2">
                                                                No
                                                            </label>
                                                            <div class="invalid-feedback">Evalúe este criterio, por favor.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Guardar evaluación</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div id="loader" class="d-none">
        <div class="text-center">
            <div class="spinner-border spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

</div>

</div>
<script src="<?php echo IP_SERVER ?>assets/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    input_criterio = $('#plantilla_criterios')
    $('.consulta_criterios').click(function () {
        boton_actividad = $(this);
        $('#evaluacion').find('.modal-title').text($(this).data('row').nombre);
        $('#evaluacion').find('.modal-body').text('');
        $('#evaluacion').find('.modal-body').append($('#loader').html());
        consultar_criterios($(this).data('row').id).then((respuesta) => {
            $('#evaluacion').find('.modal-body').text('');
            if (!respuesta.error) {
                if (respuesta.success == true) {
                    accion = "<?php echo IP_SERVER ?>usuarios/guardar_evaluacion";
                    $('#evaluacion').find('form').attr('action', accion + '/'+ boton_actividad.data('row').id);
                    criterios = respuesta.criterios
                    $.each(criterios, (index, criterio) => {
                        input = input_criterio.clone()
                        // SI YA ESTÁ EVALUADA, DESHABILITA LOS INPUTS
                        if(boton_actividad.data('row').evaluada == 1){
                            input.find(`.form-check-input`).attr('disabled',true)
                            input.find(`input[type="radio"][value="${criterio.resultado}"]`).attr('checked',true)
                        }
                        input.find('label b').text(criterio.nombre)
                        input.find('input[type="radio"]').each(function (posicion){
                            $(this).attr('id', 'resultado' + index + posicion)
                            $(this).next('label').attr('for', 'resultado' + index + posicion)
                        })
                        input.find('input[type="hidden"]').attr('value', criterio.id)
                        input.find('input[type="radio"]').attr('name', 'resultado[' + index + ']')
                        $('#evaluacion').find('.modal-body').append(`<p>${input.html()}</p>`)
                    })
                }
            } else {
                alert(respuesta.error)
            }
        })
    })

    function consultar_criterios(id_actividad) {
        return $.get(`<?php echo IP_SERVER ?>usuarios/criterios_por_cargo/<?php echo $usuarios->id_cargo?>/${id_actividad}/<?php echo $usuarios->id?>`)
    }
    // Fetch all the forms we want to apply custom Bootstrap validation styles to

    // Loop over them and prevent submission
    $.each($('form.needs-validation'), (index,form) => {
        $(form).on('submit', function (event) {
            event.preventDefault()
            event.stopPropagation()
            if (form.checkValidity()) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize()
                }).done(function( respuesta ) {
                    if(respuesta.success == true){
                        if(respuesta.url){
                            location.replace(respuesta.url)
                        }else{
                            location.reload()
                        }
                    }else{
                        console.log(respuesta.error)
                        respuesta.message = respuesta.error.join('<br>')
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            timer: 3000,
                            timerProgressBar: true,
                            title: respuesta.message,
                            icon: "error",
                            showConfirmButton: false,
                        })
                    }
                });
            }
            $(this).addClass('was-validated')
        })
    })
</script>