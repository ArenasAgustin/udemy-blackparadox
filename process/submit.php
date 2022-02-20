<?php

if (isset($_POST['submit'])) {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
        header("Location: ../contact.html?error");

        exit();
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $telephone = $_POST['tel'];
        $message = $_POST['message'];
    }
} else {
    header("Location: ../contact.html?error");
}

?>
<a href="../contact.html">Volver</a>