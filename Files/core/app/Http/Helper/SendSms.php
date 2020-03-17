<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/8/2019
 * Time: 12:37 PM
 */

namespace App\Http;
use App\Model\GeneralSetting as GS;
use App\Model\SmsTemplate;

trait SendSms
{
    /**
     * @param $to
     * @param $message
     * https://api.infobip.com/api/v3/sendsms/plain?user=****&password=*****&sender=E-Wallet&SMSText={{message}}&GSM={{number}}&type=longSMS
     */
  public  function sendSms( $to, $message){
        $settings = GS::first();
        if($settings->mn){
            $sendtext = urlencode("$message");
            $appi = $settings->sms_api;
            $appi = str_replace("{{number}}",$to,$appi);
            $appi = str_replace("{{message}}",$sendtext,$appi);
            $result = file_get_contents($appi);
        }

    }
    public function sendSmsByTemplate($to,$code,array $data=[]){
        $parse ='';
      if($sms_template = SmsTemplate::where(['type'=>$code,'status'=>1])->latest()->first()){
          $get_data = $this->smsDataSet($data,$code);
          $parse = $sms_template->template;
          foreach ($get_data as $key=>$value){
              $parse = str_replace("{{".$key."}}",$value,$parse);
          }
        };
      $this->sendSms($to,$parse);
      return [
        'to'=>$to,
        'message'=>$parse,
      ];
    }
    protected function smsDataSet($data,$code){

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