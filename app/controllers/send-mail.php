<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
require_once  dirname(dirname(__FILE__)).'/../vendor/autoload.php';
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true); // Passing `true` enables exceptions
send($_SERVER['mail_subject'], $_SERVER['mail_body'], $_SERVER['mail_recipient'], $_SERVER['mail_recipient_name']);
function send($subject, $body, $recipient, $recipient_name='')
{
    try {
        global $mail;
        //Server settings
        $mail->SMTPDebug = 2; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'west.exch027.serverdata.net;west.exch027.serverdata.net'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'webservices@adamusgh.com'; // SMTP username
        $mail->Password = '@1234NzGh'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to
        $mail->setFrom('webservices@adamusgh.com', 'Webservices@Adamusgh');
        //Recipients
        $mail->addAddress($recipient);     // Add a recipient
        /* $mail->setFrom('webservices@adamusgh.com', 'Mailer');
        $mail->addAddress('webservices@adamusgh.com');               // Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com'); */

        //Attachments
        /* $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
         */
        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        return true;
        //echo 'Message has been sent';
    }
    catch (Exception $e) {
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        return false;
    }
}
