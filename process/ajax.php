<?php

if (!isset($_POST)) {
    die('No autorisado');
}

function json_output($status = 200, $msg = 'OK', $data = [])
{
    echo json_encode(array(
        'status' => $status,
        'msg' => $msg,
        'data' => $data
    ));

    die;
}

if (empty($_POST['name'])) {
    json_output(400, 'Ingrese un nombre válido');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    json_output(400, 'Ingrese un email válido');
}

if (empty($_POST['tel'])) {
    json_output(400, 'Ingrese un teléfono válido');
}

if (empty($_POST['message']) || strlen($_POST['message']) < 5) {
    json_output(400, 'Ingrese un mensaje válido');
}
/* form data */
$info['nombre'] = $_POST['nombre'];
$info['email'] = $_POST['email'];
$info['mensaje'] = $_POST['mensaje'];
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['telefono'] = $_POST['tel'];

$info['fecha'] = date('d M Y H:i:s');

/** Just to test locally **/
$mensage = "
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
$enviar = mail($para, $asunto, $mensage, $headers);

if (!$enviar) {
    json_output(400, 'Error al enviar el correo');
} 

json_output(200, 'Mensaje enviado con éxito', $mensage);

?>