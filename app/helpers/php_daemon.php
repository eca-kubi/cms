<?php
/**
 * Created by PhpStorm.
 * User: UNCLE CHARLES
 * Date: 1/7/2019
 * Time: 1:07 PM
 */
spl_autoload_register(function ($class_name) {
    $dirs = array(
        '../models/',
        '../libraries/',
        '../classes/'
    );
    foreach ($dirs as $dir) {
        if (!file_exists('../app/' . $dir . $class_name . '.php')) {
            continue;
        } else {
            require_once('../app/' . $dir . $class_name . '.php');
        }
    }
});
require_once '../../vendor/autoload.php';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'appiahmakuta');
define('DB_PASS', 'gmail300');
define('DB_NAME', 'sms');
try {
    $mail = new PHPMailer(true); // Passing `true` enables exceptions
    //Server settings
    $mail->SMTPDebug = 0; // Enable verbose debug output
    $mail->isSMTP(); // Set mailer to use SMTP
   // $mail->Host = 'west.exch027.serverdata.net;west.exch027.serverdata.net'; // Specify main and backup SMTP servers
    $mail->Host = 'smtp.office365.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'webservices@adamusgh.com'; // SMTP username
    //$mail->Password = '@1234NzGh'; // SMTP password
    $mail->Password = '!1234NzGh'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to
    $mail->setFrom('webservices@adamusgh.com', 'CMS@Adamusgh');
    while (true) {
        $emails = fetch_email();
        foreach ($emails as $email) {
            $mail->addAddress($email->recipient_address, $email->recipient_name);     // Add a recipient
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Re: ' . $email->subject;
            //$mail->MessageID = '<' . $mail->Subject . '@cms>';
            //$mail->addCustomHeader('In-Reply-To', '<' . $email->subject . '@cms>');
            //$mail->addCustomHeader('References', '<' . $email->subject . '@cms>');
            $mail->Body = $email->body;
            if ($mail->send()) {
                update_status($email->email_id);
            }
            $mail->clearAddresses();
        }
        sleep(10);
    }
} catch (Exception $e) {
    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

function fetch_email(): array
{
    $db = Database::getDbh();
    $ret = $db->where('sent', false)->
    objectBuilder()->
    get('cms_email');
    return $ret;
}

function update_status($id)
{
    Database::getDbh()->where('email_id', $id)->
    update('cms_email', ['sent' => true]);
}