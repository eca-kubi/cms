<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true); // Passing `true` enables exceptions
function sendMail()
{
    try {
        global $mail;
        //Server settings
        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'west.exch027.serverdata.net;west.exch027.serverdata.net'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'webservices@adamusgh.com'; // SMTP username
        $mail->Password = '@1234NzGh'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to
        $mail->setFrom('webservices@adamusgh.com', 'Webservices@Adamusgh');
        $emails = Database::getDbh()
            ->objectBuilder()
            ->where('sender_user_id', getUserSession()->user_id)
            ->where('sent', false)
            ->get('cms_email');
        foreach ($emails as $email) {
            $mail->addAddress($email->recipient_address, $email->recipient_name);     // Add a recipient
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $email->subject;
            $mail->Body = $email->body;
            //msgHTML also sets AltBody, but if you want a custom one, set it afterwards
            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if ($email->parent) {
                $mail->MessageID = '<' . $mail->Subject . '@cms>';
            }
            if ($email->follow_up) {
                $mail->Subject = 'Re: ' . $mail->Subject;
                $mail->addCustomHeader('In-Reply-To', '<' . $email->subject . '@cms>');
                $mail->addCustomHeader('References', '<' . $email->subject . '@cms>');
            }
            if (!$mail->send()) {
                //"Mailer Error (" . str_replace("@", "&#64;", $mail->body) . ') ' . $mail->ErrorInfo . '<br />';
                //$mail->ErrorInfo . '<br />';
                return false;
                //break; //Abandon sending
            }
            $mail->clearAddresses();
        }
// update emails sent status
        Database::getDbh()->
        where('sender_user_id', getUserSession()->user_id)->
        update('cms_email', ['sent' => true]);
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
        return true;
        //echo 'Message has been sent';
    } catch (Exception $e) {
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        return false;
    }
}
