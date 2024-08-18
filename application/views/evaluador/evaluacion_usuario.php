
<div class="row py-5 animate__animated animate__fadeIn ">
    <div class="row">
        <div class="col-md-2 col-2 ">

        </div>
        <div class="col-md-9 col-9 mx-auto"> <!-- Profile widget -->
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

                                <?php echo $usuario->nombre . ' ' . $usuario->apellido ?>
                            </h4>
                            <p class=" m-0 p-0 ">
                                Cargo:
                                <?php echo $usuario_info->nombre_cargo?>
                            </p>

                            <p class=" small m-0 p-0">
                                Correo:
                                <?php echo $usuario->email ?>
                            </p>
                        </div>
                    </div>
                </div>
                <h5 class="mb-2 ms-2 mt-3">Competencias asignadas al colaborador:
                    <?php echo $usuario->nombre . ' ' . $usuario->apellido ?>
                </h5>
                <?php if(!empty($competencias_cargo)){ foreach ($competencias_cargo as $row) { ?>
                    <div class="px-4 py-3">
                        <div class="p-4 card-competencia rounded shadow-sm">

                            <a
                                href="<?php echo IP_SERVER    ?>Usuarios/evaluacion/<?php echo $usuario->id?>/<?php  echo $row->id?>">
                                <h6 class="mb-0">
                                    Competencia:
                                    <?php echo $row->nombre; ?> <!-- Muestra el nombre de la competencia -->
                                </h6>
                                <p class="my-2">
                                    Descripcion:
                                    <?php echo $row->descripcion; ?> <!-- Muestra el ID de la competencia -->
                                </p>
                            </a>
                        </div>
                    </div>
                <?php }}else{?>
                    <div class="px-4 py-3">
                        <div class="p-4 card-competencia rounded shadow-sm">
                            <a>
                                <h6 class="text-center my-2">
                                    No hay competencias asignadas para evaluar
                                </h6>
                            </a>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>