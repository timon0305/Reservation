<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/8/2019
 * Time: 7:22 PM
 */

namespace App\Http;

use App\Model\EmailTemplate;
use App\Model\GeneralSetting as GS;
trait SendEmail
{
    public function sendEmail($to, $name, $subject, $message,$attach=null){
        $settings = GS::first();
        if($settings->en){
            $template = $settings->email_message;
            $from = $settings->sender_email;

            $headers = "From: $settings->title <$from> \r\n";
            $headers .= "Reply-To: $settings->title <$from> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $mm = str_replace("{{name}}",$name,$template);
            $message = str_replace("{{message}}",$message,$mm);
            if(null !==$attach){
                $message .= "<br/><br/><br/><br/><a href='".$attach."'>Attach</a>";
            }
            mail($to, $subject, $message, $headers);
        }

    }
    public function sendEmailByTemplate($to,$name,$subject,$code,array $data=[],$attach=null){
        $parse ='';
        if($email_template = EmailTemplate::where(['type'=>$code,'status'=>1])->latest()->first()){

            $get_data = $this->emailDataSet($data,$code);

            $parse = $email_template->template;
            if(count($get_data)){
                foreach ($get_data as $key=>$value){
                    $parse = str_replace("{{".$key."}}",$value,$parse);
                }
            }

        };
        $this->sendEmail($to,$name,$subject,$parse,$attach);
    }
    protected function emailDataSet($data,$code){

        $arr = [
            'P_APPOINTMENT'=>[
                'patient_id'=>array_key_exists('patient_id',$data)?$data['patient_id']:'',
                'patient_name'=>array_key_exists('patient_name',$data)?$data['patient_name']:'',
                'appointment_id'=>array_key_exists('appointment_id',$data)?$data['appointment_id']:'',
                'schedule'=>array_key_exists('schedule',$data)?$data['schedule']:'',
            ]
        ];
        if(array_key_exists($code,$arr)){
            return $arr[$code];
        }
        return [];

    }
}