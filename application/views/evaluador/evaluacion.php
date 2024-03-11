<!-- <pre><?php  // echo  print_r($actividades_clave, true)  ?> </pre> -->
<div class="row py-5  ">
    <div class="row">
        <div class="col-md-2 ">

        </div>
        <div class="col-md-9 mx-auto"> <!-- Profile widget -->
            <div class="bg-white shadow  mb-4 rounded overflow-hidden">
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
                                Area:
                                <?php echo $area ?>
                            </p>
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
                                    <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#evaluacion<?php echo $row->id ?>">
                                        Comenzar evaluación
                                    </a>
                                </div>

                            </div>
                            <!-- Modal -->


                            <div class="modal modal-lg fade" id="evaluacion<?php echo $row->id ?>"
                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                <?php echo $row->nombre ?>
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            criterios
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success">Guardar evaluación</button>
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

</div>