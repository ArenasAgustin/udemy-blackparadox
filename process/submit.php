<?php

if (isset($_POST['submit'])) {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
        /* Some inputs are empty */
        header("Location: ../contacto.html?llena-todos-los-campos");
        exit();
    } else {
        /* form data */
        $info[''] = $_POST['name'];
        $info['email'] = $_POST['email'];
        $info['message'] = $_POST['message'];
        $info['ip'] = $_SERVER['REMOTE_ADDR'];
        $info['telephone'] = $_POST['tel'];

        if (empty($_POST['tel'])) {
            $info['telephone'] = 'No ingresó número de teléfono';
        }

        $info['date'] = date('d M Y H:i:s');

        /** Just to test locally **/
        $menssage = "
            <html>
            <body>
            <h3>Tu mensaje ha sido enviado</h3>
            <p><strong>Nombre:</strong> {$info['name']}</p>
            <p><strong>E-mail:</strong> {$info['email']}</p>
            <p><strong>Teléfono:</strong> {$info['telephone']}</p>
            <p><strong>Mensaje:</strong> {$info['message']}</p>
            <br>
            <p><strong>IP: </strong> {$info['ip']}</p>
            <p><strong>Fecha: </strong> {$info['date']}</p>
                
            </body>
            </html>
            ";

        /** Send real email **/
        $to = $info['email'];
        $from = $info['email'];

        $topic = "Correo de Blackparadox - Blackparadox";

        $headers = "From: $from\r\n";
        $headers .= "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type: text/html; charset=utf-8 \r\n";

        /* Send email */
        $send = mail($to, $topic, $menssage, $headers);

        if ($send) {
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