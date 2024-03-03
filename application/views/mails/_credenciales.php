<div style="max-width: 620px; width:100%; display: flex; justify-content: center; background-color: #fafafa; padding: 40px; padding-top:20px;">
    <table border="0" cellpadding="1" cellspacing="1" style="padding:20px; background-color: #ffffff; font-family:Helvetica;font-size:13px;line-height:150%;text-align: justify;text-justify: inter-word;">
        <tbody>
            <tr>
                <td>
                    <p><b><?php echo mb_strtoupper($usuario->nombre . ' '.  $usuario->apellido)?></b></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Por medio de este correo notificamos que ha sido añadido al aula de competencias. A continuación, extendemos las credenciales de acceso al mismo.</p><br>
                    <p>Correo: <b><?php echo $usuario->email?></b></p>
                    <p>Contraseña: <b>aula<?php echo $usuario->identificacion?></b></p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-size:16px">
                    <p><a style="background-color: #08458D; color: white; padding:10px; text-decoration: none; border-radius: 5px;" href="<?php echo IP_SERVER?>"><b>INGRESAR AL AULA</b></a></p>
                    <br>
                    <img style="height:200px" src="cid:main_logo" alt="main_logo">
                </td>
            </tr>
        </tbody>
    </table>

</div>

<p> </p>