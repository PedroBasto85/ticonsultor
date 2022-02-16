<?
date_default_timezone_set('America/Mexico_City');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require_once('smtp.php');
require 'clases/phpmailer/Exception.php';
require 'clases/phpmailer/PHPMailer.php';
require 'clases/phpmailer/SMTP.php';

$MensajeCompleto = "";
$TemasInteres = "";
$errores['error'] = '';
/*$sisadmin = '';
$software = '';
$hardware = '';
$networking = '';
$presencia = '';
$soporte = '';
$seguridad = '';
$ecom = '';*/

try {
    $Nombre = $_POST["nombre"];
    $Correo = $_POST["correo"];
    $Telefono = $_POST["telefono"];
    $Mensaje= $_POST["mensaje"];
    $Temas = $_POST["temas"];

    if (count($Temas) == 0){
        $TemasInteres = 'NINGUNO';
    }else{
        $TemasInteres = implode('<br>',$Temas);
    }


    $MensajeCompleto = '<b>Nombre: </b>' . $Nombre . '<br>' . '<b>Correo: </b> ' . $Correo . '<br>' . '<b>Telefono: </b>' . $Telefono . '<br>' . '<b>Mensaje: </b> ' . $Mensaje. '<br><br>';
    //$TemasInteres = $sisadmin .  $software . $hardware . $networking .  $presencia .  $soporte .  $seguridad .  $ecom;
    $MensajeCompleto = $MensajeCompleto . 'TEMAS SELECCIONADOS: '.'<br>'. $TemasInteres;
    $fecharecibido = date('d/m/Y H:m');
    $leyenda = '<p>'.'Este mensaje fue generado en el sitio web <b>www.ticonsultor.mx</b>'.'</p>';
    $MensajeCompleto = $MensajeCompleto . '<br><br>'. $leyenda. '<br>'.'Fecha de envio: '. $fecharecibido. ' Hora de la Ciudad de México';


    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;

    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = correo_smtpsecure;
    $mail->Host = correo_host;
    $mail->Port = correo_port;
    $mail->Username = correo_username;
    $mail->Password = correo_password;


    $mail->setFrom(correo_username, 'Sitio web');
    $mail->Subject = "Mensaje Sitio Web";
    $address = correo_destino;
    $mail->addAddress($address, $address);

    $mail->isHTML(true);
    $mail->msgHTML($MensajeCompleto);


    if (!$mail->send()) {
        $errores['error'] = $mail->ErrorInfo;
    }


    /*$mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->From = "rlizarraga.ti@gmail.com";
    $mail->FromName = "Pedro";

    $mail->addAddress("lizbatec@hotmail.com", "Destino");


    $mail->isHTML(true);
    $mail->msgHTML($MensajeCompleto);

    $mail->Subject = "Subject Text";
    $mail->Body = $MensajeCompleto;
    $mail->AltBody = "This is the plain text version of the email content";

    if(!$mail->send()) {
        $errores['error']=$mail->ErrorInfo;
        echo "ocurrió un error";
    }*/


} catch (Exception $e) {

}

echo json_encode($errores);
