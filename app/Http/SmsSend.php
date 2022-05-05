<?php

namespace App\Http;

class SmsSend
{

    protected $phone = null;
    protected $link = null;
    protected $sms_tex = null;
    protected $login = null;
    protected $password = null;
    protected $sender_id = null;





    public function __construct($phone, $link, $sms)
    {

        $this->transactionId = $link;
        $this->phone = $phone;
        $this->sms_text = $sms;
        $this->login = env("SMS_LOGIN", "elapteka");
        $this->password = env("SMS_PASSWORD","fUSRCsAB");
        $this->sender_id = env("SMS_ID", "PHARMBILIM");

        $sms_text = "$this->sms_text: $this->transactionId";

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".
                "<message>".
                    "<login>" . $this->login . "</login>".
                    "<pwd>" . $this->password . "</pwd>".
                    "<id>" . $this->transactionId . "</id>".
                    "<sender>" . $this->sender_id . "</sender>".
                    "<text>" . $sms_text . "</text>".

                    "<phones>".
                    "<phone>" . $this->phone . "</phone>".
                    "</phones>".
                    
                "</message>";   

        $url = "http://smspro.nikita.kg/api/message";
        $uagent = $_SERVER ['HTTP_USER_AGENT'];

        $ch = curl_init( $url );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_COOKIEJAR, "c://coo.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE,"c://coo.txt");

        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;

    }

    public function post_content()
    {
        
    }


}
