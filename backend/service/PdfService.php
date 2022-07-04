<?php
namespace Backend\Service;

use createPDF;

class PdfService
{

    public static function make($data){
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



        $html = '';
        if(isset($data['captcha']) ) {unset($data['captcha']);}
        if(isset($data['g-recaptcha-response']) ) {unset($data['g-recaptcha-response']);}

        $lastKeyMultiArray = null;
        foreach ($data as $key => $value){
            if(is_array($value)){
                if($lastKeyMultiArray === null || $lastKeyMultiArray != $key){
                    $lastKeyMultiArray = $key;
                        $html .= sprintf('<h3>%s</h3>  <br><br><br><br>', ucfirst(str_replace('_', ' ',$key)));
                }


                foreach($value as $k => $v){
                    if(is_string($k) && is_string($v) ){
                        $html .= sprintf('<grey>%s</grey> <br> <h4>%s</h4> <br><br><br><br><br>', ucfirst(str_replace('_', ' ',$k)), $v);
                    }

                }
            }else{
                if(is_string($key) && is_string($value) ) {
                    $html .= sprintf('<grey>%s</grey> <br> <h4>%s</h4> <br><br><br><br><br>', ucfirst(str_replace('_', ' ',$key)), $value);
                }
            }
        }
        $pdf =  new createPDF($html, $title, APP_URL,'',   time());

        return $pdf->run();

    }
}