<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>


<pre><?php echo print_r($data->sexo, true) ?></pre>



<style>
    .error {
        border-color: red !important;
    }
</style>

<body>

    <div class="container">
        <h2 class="mt-4">Editar Usuario</h2>
        <form action="<?php echo site_url('usuarios/guardar_edicion'); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $data->id ?>">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data->nombre ?>">
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select class="form-control" id="sexo" name="sexo">
                    <option value="" <?php echo isset($data) && ($data->sexo != 'Masculino' && $data->sexo != 'Femenino') ? 'selected' : '' ?> disabled>seleccione----</option>
                    <option value="Masculino" <?php echo isset($data) && $data->sexo == 'Masculino' ? 'selected' : '' ?>>
                        Masculino
                    </option>
                    <option value="Femenino" <?php echo isset($data) && $data->sexo == 'Femenino' ? 'selected' : '' ?>>
                        Femenino
                    </option>
                    <!-- Otras opciones aquí -->
                </select>
            </div>


            <div class="form-group">
                <label for="tipo_vinculacion">Tipo de Vinculación:</label>
                <input type="text" class="form-control" id="tipo_vinculacion" name="tipo_vinculacion" value="">
            </div>



            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            var valor_seleccionado = $('#sexo').val();
            if (valor_seleccionado !== 'Masculino' && valor_seleccionado !== 'Femenino') {
                $('#sexo').addClass('error').focus();
            }
        });
    </script>

    </script>



</body>

</html>