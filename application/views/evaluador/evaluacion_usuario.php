<!-- <pre><?php //echo print_r($usuarios, true)        ?> </pre> -->
<div class="row py-5  ">
    <div class="row">
        <div class="col-md-2 ">

        </div>
        <div class="col-md-9 mx-auto"> <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0  cover">
                    <div class="media align-items-end profile-head">
                        <div class="profile mr-3">
                            <img src="<?php echo IP_SERVER ?>assets/img/avatar.webp" alt="..." width="130"
                                class="rounded-circle shadow  mb-2 border img-thumbnail">
                        </div>
                        <div class="media-body ">
                            <h4 class="mt-0 mb-0">
                                <?php echo $usuarios->nombre . ' ' . $usuarios->apellido ?>
                            </h4>
                            <p class="small ">
                                <?php echo $usuarios->cargo ?>
                            </p>
                            <p class="small ">
                                <?php echo $usuarios->email ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-3">
                    <h5 class="mb-2">Competencia</h5>
                    <div class="p-4 rounded shadow-sm bg-light">
                        <h6 class="mb-0">GESTIONAR EL RETIRO DE GL POR CAMIONES Y/O GASODUCTO</h6>
                        <p class="my-2">Es la capacidad de llevar a cabo el retiro de GL desde el proveedor,
                            a través de camiones cisterna
                            o gasoducto, de acuerdo a 10 programado y asegurando las condiciones de satisfacción y
                            estándares de servicio.</p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>