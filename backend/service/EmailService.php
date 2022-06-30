<?php

namespace Backend\Service;

use PHPMailer\PHPMailer\PHPMailer;

class EmailService
{
    public static function send($pdf = '', &$result = []){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);


        try {
            //Server settings
//        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            if(MAIL_MAILER == 'smtp'){
                $mail->isSMTP();                                            //Send using SMTP
            }


            $mail->Host       = MAIL_HOST;                     //Set the SMTP server to send through 'smtp.example.com'
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = MAIL_USERNAME;                     //SMTP username
            $mail->Password   = MAIL_PASSWORD;                               //SMTP password
            if(MAIL_ENCRYPTION == 'tls' || MAIL_ENCRYPTION == 'ssl'){
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            }

            $mail->Port       = MAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS` but default 465

            //Recipients
            $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
            $mail->addAddress(MAIL_TO, MAIL_FROM_NAME);     //Add a recipient
//        $mail->addAddress('ellen@example.com');               //Name is optional
//        $mail->addReplyTo('info@example.com', 'Information');
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');

            //Attachments
//        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            $mail->addStringAttachment($pdf, 'my-doc.pdf');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold! #2</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
//        echo 'Message has been sent';
            $result = ['result' => true, 'message' => 'success', 'data' => []];
            return true;
        } catch (Exception $e) {
            $result = ['result' => false, 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"];
            return false;
        }
    }

}