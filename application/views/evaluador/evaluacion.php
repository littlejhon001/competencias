<!-- <pre><?php  // echo  print_r($resultado, true)       ?> </pre> -->
<div class="row py-5">
    <div class="row">
        <div class="col-md-2 ">

        </div>
        <div class="col-md-9 mx-auto ">
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

                                    <?php if (empty ($resultado)) { ?>
                                        <a type="button" class="btn btn-primary consulta_criterios" data-bs-toggle="modal"
                                            data-bs-target="#evaluacion" data-row='<?php echo json_encode($row); ?>'>
                                            Comenzar evaluación
                                        </a>
                                    <?php } else { ?>
                                        <a type="button" class="btn btn-primary consulta_criterios disabled" data-bs-toggle="modal"
                                            data-bs-target="#evaluacion" data-row='<?php echo json_encode($row); ?>'>
                                            Evaluación finalizada
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
                                    <form novalidate class="needs-validation"
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
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="resultado" value="3" id="resultado3">
                                                            <label class="form-check-label" for="resultado3">
                                                                No aplica
                                                            </label>
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


</div>

</div>
<script src="<?php echo IP_SERVER ?>assets/jquery/jquery.min.js"></script>

<script>
    input_criterio = $('#plantilla_criterios')
    $('.consulta_criterios').click(function () {
        $('#evaluacion').find('.modal-title').text($(this).data('row').nombre);
        $('#evaluacion').find('.modal-body').text('');
        criterios = $(this).data('row').criterios
        $.each(criterios, (index, criterio) => {
            input = input_criterio
            input.find('label b').text(criterio.nombre)
            input.find('input[type="radio"]').each(function (posicion){
                $(this).attr('id', 'resultado' + index + posicion)
                $(this).next('label').attr('for', 'resultado' + index + posicion)
            })
            input.find('input[type="hidden"]').attr('value', criterio.id)
            input.find('input[type="radio"]').attr('name', 'resultado[' + index + ']')
            $('#evaluacion').find('.modal-body').append(`<p>${input.html()}</p>`)
        })
    })

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
</script>