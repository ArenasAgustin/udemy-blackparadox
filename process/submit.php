<?php

if (isset($_POST['submit'])) {
    if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['mensaje'])) {
        /* Some inputs are empty */
        header("Location: ../contacto.html?llena-todos-los-campos");
        exit();
    } else {
        /* form data */
        $info['nombre'] = $_POST['nombre'];
        $info['email'] = $_POST['email'];
        $info['mensaje'] = $_POST['mensaje'];
        $info['ip'] = $_SERVER['REMOTE_ADDR'];
        $info['telefono'] = $_POST['tel'];

        if (empty($_POST['tel'])) {
            $info['telefono'] = 'No ingresó número de teléfono';
        }

        $info['fecha'] = date('d M Y H:i:s');

        /** Just to test locally **/
        $mensaje = "
            <html>
            <body>
            <h3>Tu mensaje ha sido enviado</h3>
            <p><strong>Nombre:</strong> {$info['nombre']}</p>
            <p><strong>E-mail:</strong> {$info['email']}</p>
            <p><strong>Teléfono:</strong> {$info['telefono']}</p>
            <p><strong>Mensaje:</strong> {$info['mensaje']}</p>
            <br>
            <p><strong>IP: </strong> {$info['ip']}</p>
            <p><strong>Fecha: </strong> {$info['fecha']}</p>
                
            </body>
            </html>
            ";

        /** Send real email **/
        $para = $info['email'];
        $de = $info['email'];

        $asunto = "Correo de Blackparadox - Blackparadox";

        $headers = "From: $de\r\n";
        $headers .= "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type: text/html; charset=utf-8 \r\n";

        /* Send email */
        $enviar = mail($para, $asunto, $mensaje, $headers);

        if ($enviar) {
            header("Location: ../contacto.html?success");
            exit();
        } else {
            header("Location: ../contacto.html?error");
            exit();
        }
    }
} else {
    /** If the form is not sent return to contact with error **/
    header("Location: ../contacto.html?error");
}

?>

<br>
<a href="../contacto.html">Regresar</a>