<?php

namespace Backend\Service;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailService
{
    public static function send($pdf = '', &$result = [], $data = []){
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
            $mail->addStringAttachment($pdf, self::getTitle($data).'.pdf');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = self::getTitle($data);
            $mail->Body    = self::getHtml($data);
            $mail->AltBody = self::getHtml($data);

            $mail->send();
//        echo 'Message has been sent';
            $result = ['result' => true, 'message' => 'success', 'data' => []];
            return true;
        } catch (Exception $e) {
            $result = ['result' => false, 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"];
            return false;
        }
    }

    public static function getTitle($data){
        $title = 'none';
        if (isset($data['corporate_details'])) {
            $title = 'Requirements of the project';

        } elseif (isset($data['clients'])) {
            $title = 'Get in touch [Client]';

        }

        if(isset($data['partners_form'])){
            $title = 'Data for partnership';
            if(count($data)==6){
                $title = 'Get in touch [Partner]';
            }
        }

        return $title;
    }

    public static function getHtml($data){
        $html = '<div style="max-width: 500px">';
        if(isset($data['captcha']) ) {unset($data['captcha']);}
        if(isset($data['g-recaptcha-response']) ) {unset($data['g-recaptcha-response']);}

        $lastKeyMultiArray = null;
        foreach ($data as $key => $value){
            if(is_array($value)){
                if($lastKeyMultiArray === null || $lastKeyMultiArray != $key){
                    $lastKeyMultiArray = $key;
                    $html .= sprintf('<h3>%s</h3> ', ucfirst(str_replace('_', ' ',htmlentities($key, ENT_QUOTES | ENT_IGNORE, "UTF-8"))));
                }


                foreach($value as $k => $v){
                    if(is_string($k) && is_string($v) ){
                        $html .= sprintf('<div style="color: #797979">%s <div style="color: #151515"><b>%s</b> </div></div><br>', ucfirst(str_replace('_', ' ',htmlentities($k, ENT_QUOTES | ENT_IGNORE, "UTF-8"))), htmlentities($v, ENT_QUOTES | ENT_IGNORE, "UTF-8"));
                    }

                }
            }else{
                if(is_string($key) && is_string($value) ) {
                    $html .= sprintf('<div style="color: #797979">%s <div style="color: #151515"><b>%s</b> </div></div><br>', ucfirst(str_replace('_', ' ',htmlentities($key, ENT_QUOTES | ENT_IGNORE, "UTF-8"))), htmlentities($value, ENT_QUOTES | ENT_IGNORE, "UTF-8"));
                }
            }
        }
        $html .= '</div>';

        return $html;
    }


}