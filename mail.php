<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Mail</title>
</head>

<body>
<h1>Enviar Mail</h1>
    <form method="post">
        <label for="destinatario">Destinatario:</label>
        <input type="email" id="destinatario" name="destinatario" required>
        <br>

        <label for="tittle">Título:</label>
        <input type="text" id="tittle" name="tittle" required>
        <br>

        <label for="content">Contenido del Mensaje:</label>
        <textarea id="content" name="content" required></textarea>
        <br>

        <label for="cc">CC:</label>
        <input type="email" id="cc" name="cc">
        <br>

        <label for="email">Tu Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="password">Tu Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <input type="submit" value="Enviar">
    </form>

    <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destinatario = $_POST["destinatario"];
    $tittle = $_POST["tittle"];
    $content = $_POST["content"];
    $cc = isset($_POST["cc"]) ? $_POST["cc"] : "";
    $email = $_POST["email"];
    $password = $_POST["password"];

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";

    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = $email;
    $mail->Password   = $password;

    $mail->IsHTML(true);
    $mail->AddAddress($destinatario);
    $mail->SetFrom($email, "Aleix");

    if (!empty($cc)) {
        $mail->AddCC($cc);
    }

    $mail->Subject = $tittle;
    $mail->MsgHTML($content);

    if (!$mail->Send()) {
        echo "Error al enviar el correo electrónico.";
        var_dump($mail);
    } else {
        echo "Correo electrónico enviado exitosamente.";
    }
}
?>


</body>

</html>

    
