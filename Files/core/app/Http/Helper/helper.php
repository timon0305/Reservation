<?php
use App\Model\GeneralSetting as GS;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



if (! function_exists('active_menu')) {

    function active_menu($arr,$result='',$extra=null){
        $results = '';
        if(in_array(url()->current(),$arr)){
            $results = $result;
        }else{
            if (null !== $extra){
                if(in_array(request()->route()->getName(),$extra)){
                    $results = $result;
                }
            }
        }
        return $results;
    }
}
if (! function_exists('auth_user')) {

    function auth_user() {
        $user =null;
        foreach (auth_guard() as $k=>$v){
            if(auth()->guard($k)->check()) {
                $user = auth()->guard($k)->user();
                $user['guard'] = $k;
            }
        }
        return $user;
    }
}
if (! function_exists('auth_guard')) {
    function auth_guard() {
        $guard =config('auth.guards') ;
        unset($guard['web']);
        unset($guard['api']);
        $guards = $guard;
        foreach ($guard as $k=>$v){
            $guards[$k]['model']= config('auth.providers')[$v['provider']]['model'];
        }
        return $guards;
    }
}
if (! function_exists('check_role')) {
    function check_role($role) {
        if(is_array($role)){
            foreach ($role as $k=>$v){
                if(auth()->guard($v)->check()){
                    return true;
                }
            }
        }else{
            if(auth()->guard($role)->check()){
                return true;
            }
        }
        return false;
    }
}
if (! function_exists('general_setting')) {

    function general_setting() {

        $gl_setting = GS::first();
        $gl_setting['logo'] = asset('assets/logo.png');
        $gl_setting['favicon'] = asset('assets/favicon.png');
        return $gl_setting;
    }
}
if (! function_exists('web_setting')) {

    function web_setting() {

        $gl_setting = \App\Model\WebSetting::first();
        return $gl_setting;
    }
}

if(!function_exists('show_ad')) {
    function show_ad($size) {
        $ad = \App\Model\Advertisement::where('size', $size)->inRandomOrder()->first();
        if (!empty($ad)) {
            if($size == 1){
                $maxwd = '300px';
                $maxhi = '250px';
            } elseif($size == 2){
                $maxwd = '728px';
                $maxhi = '90px';
            }elseif($size == 3){
                $maxwd = '300px';
                $maxhi = '600px';
            }

            if ($ad->type == 1) {
                return '<a target="_blank" href="'.$ad->redirect_url.'"><img src="'.asset('/assets/admin/img/advertisement/'.$ad->image).'" alt="" style="width:100%; max-width:'.$maxwd.';height: 100%;max-height: '.$maxhi.'"/></a>';
            }
            if($ad->type == 2) {
                return $ad->script;
            }
        } else {
            return '';
        }

    }
}
if(!function_exists('hex2rgba')) {
    function hex2rgba($color, $opacity = false) {

        $default = 'rgb(0,0,0)';


        if(empty($color))
            return $default;


        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }


        if (strlen($color) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }


        $rgb =  array_map('hexdec', $hex);


        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }


        return $output;
    }





    if(!function_exists("encrypt_e")) {
        function encrypt_e($input, $ky) {
            $key   = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );
            return $data;
        }
    }

    if(!function_exists("decrypt_e")) {
        function decrypt_e($crypt, $ky) {
            $key   = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_decrypt ( $crypt , "AES-128-CBC" , $key, 0, $iv );
            return $data;
        }
    }

    if(!function_exists("pkcs5_pad_e")) {
        function pkcs5_pad_e($text, $blocksize) {
            $pad = $blocksize - (strlen($text) % $blocksize);
            return $text . str_repeat(chr($pad), $pad);
        }
    }

    if(!function_exists("pkcs5_unpad_e")) {
        function pkcs5_unpad_e($text) {
            $pad = ord($text{strlen($text) - 1});
            if ($pad > strlen($text))
                return false;
            return substr($text, 0, -1 * $pad);
        }
    }

    if(!function_exists("generateSalt_e")) {
        function generateSalt_e($length) {
            $random = "";
            srand((double) microtime() * 1000000);

            $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
            $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
            $data .= "0FGH45OP89";

            for ($i = 0; $i < $length; $i++) {
                $random .= substr($data, (rand() % (strlen($data))), 1);
            }

            return $random;
        }
    }


    if(!function_exists("checkString_e")) {
        function checkString_e($value) {
            $myvalue = ltrim($value);
            $myvalue = rtrim($myvalue);
            if ($myvalue == 'null')
                $myvalue = '';
            return $myvalue;
        }
    }

    if(!function_exists("getChecksumFromArray")) {
        function getChecksumFromArray($arrayList, $key, $sort = 1) {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str         = getArray2Str($arrayList);
            $salt        = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash        = hash("sha256", $finalString);
            $hashString  = $hash . $salt;
            $checksum    = encrypt_e($hashString, $key);
            return $checksum;
        }
    }

    if(!function_exists("verifychecksum_e")) {
        function verifychecksum_e($arrayList, $key, $checksumvalue) {
            $arrayList = removeCheckSumParam($arrayList);
            ksort($arrayList);
            $str        = getArray2StrForVerify($arrayList);
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt       = substr($paytm_hash, -4);

            $finalString = $str . "|" . $salt;

            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;

            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }
    }

    if(!function_exists("getArray2Str")) {
        function getArray2Str($arrayList) {
            $findme   = 'REFUND';
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pos = strpos($value, $findme);
                $pospipe = strpos($value, $findmepipe);
                if ($pos !== false || $pospipe !== false)
                {
                    continue;
                }

                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
    }

    if(!function_exists("getArray2StrForVerify")) {
        function getArray2StrForVerify($arrayList) {
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
    }

    if(!function_exists("redirect2PG")) {
        function redirect2PG($paramList, $key) {
            $hashString = getchecksumFromArray($paramList);
            $checksum   = encrypt_e($hashString, $key);
        }
    }


    if(!function_exists("removeCheckSumParam")) {
        function removeCheckSumParam($arrayList) {
            if (isset($arrayList["CHECKSUMHASH"])) {
                unset($arrayList["CHECKSUMHASH"]);
            }
            return $arrayList;
        }
    }

    if(!function_exists("getTxnStatus")) {
        function getTxnStatus($requestParamList) {
            return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
        }
    }

    if(!function_exists("initiateTxnRefund")) {
        function initiateTxnRefund($requestParamList) {
            $CHECKSUM                     = getChecksumFromArray($requestParamList, PAYTM_MERCHANT_KEY, 0);
            $requestParamList["CHECKSUM"] = $CHECKSUM;
            return callAPI(PAYTM_REFUND_URL, $requestParamList);
        }
    }

    if(!function_exists("callAPI")) {
        function callAPI($apiURL, $requestParamList) {
            $jsonResponse      = "";
            $responseParamList = array();
            $JsonData          = json_encode($requestParamList);
            $postData          = 'JsonData=' . urlencode($JsonData);
            $ch                = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData)
            ));
            $jsonResponse      = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }
    }

    if(!function_exists("sanitizedParam")) {
        function sanitizedParam($param) {
            $pattern[0]     = "%,%";
            $pattern[1]     = "%#%";
            $pattern[2]     = "%\(%";
            $pattern[3]     = "%\)%";
            $pattern[4]     = "%\{%";
            $pattern[5]     = "%\}%";
            $pattern[6]     = "%<%";
            $pattern[7]     = "%>%";
            $pattern[8]     = "%`%";
            $pattern[9]     = "%!%";
            $pattern[10]    = "%\\$%";
            $pattern[11]    = "%\%%";
            $pattern[12]    = "%\^%";
            $pattern[13]    = "%=%";
            $pattern[14]    = "%\+%";
            $pattern[15]    = "%\|%";
            $pattern[16]    = "%\\\%";
            $pattern[17]    = "%:%";
            $pattern[18]    = "%'%";
            $pattern[19]    = "%\"%";
            $pattern[20]    = "%;%";
            $pattern[21]    = "%~%";
            $pattern[22]    = "%\[%";
            $pattern[23]    = "%\]%";
            $pattern[24]    = "%\*%";
            $pattern[25]    = "%&%";
            $sanitizedParam = preg_replace($pattern, "", $param);
            return $sanitizedParam;
        }
    }

    if(!function_exists("callNewAPI")) {
        function callNewAPI($apiURL, $requestParamList) {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData =json_encode($requestParamList);
            $postData = 'JsonData='.urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($postData))
            );
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse,true);
            return $responseParamList;
        }
    }



}
if (! function_exists('days_arr')){
    function days_arr(){
        return [
            1=>'sunday',
            2=>'monday',
            3=>'thursday',
            4=>'wednesday',
            5=>'tuesday',
            6=>'friday',
            7=>'saturday',
        ];

    }
}
if (! function_exists('month_arr')){
    function month_arr(){
        return [
            1=>'January',
            2=>'February',
            3=>'March',
            4=>'April',
            5=>'May',
            6=>'June',
            7=>'July',
            8=>'August',
            9=>'September',
            10=>'October',
            11=>'November',
            12=>'December'
        ];

    }
}