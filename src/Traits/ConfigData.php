<?php

declare(strict_types=1);

namespace App\Traits;
use Defuse\Crypto\Crypto;

trait ConfigData
{
    public function getConfigData(): array
    {

        $file_path = dirname(dirname(dirname(__FILE__))) . getenv('CONFIG_FILE');
        $encrypt_key_location = dirname(dirname(dirname(__FILE__)))  . getenv('ENCRYPT_KEY_FILE') ?? dirname(dirname(dirname(__FILE__))) . '/encrypt.key';
        //echo $file_path;
        //echo $encrypt_key_location;
        //die();

        if(file_exists($file_path) && file_exists($encrypt_key_location)) {
            $key = unserialize(file_get_contents($encrypt_key_location));
            $config = Crypto::decrypt(file_get_contents($file_path), $key);

            return json_decode($config, true);
        }
        return [];
    }

    public function getQrCodes($code_text = null) {
        $configData = $this->getConfigData();
        if($code_text === null ) {
            if(array_key_exists('qrcode', $configData)) {
                return $configData['qrcode'];
            }
        }
        else {
            if(array_key_exists('qrcode', $configData)) {
                foreach($configData['qrcode'] as $qrcode) {
                    if($qrcode['codeText'] == $code_text) {
                        return $qrcode;
                    }
                }
                return false;
            }
            return false;
        }
    }

    public function getCfc1ConfigData(): array  {
       return  json_decode('{
            "version": "0.0.1",
            "churchName": "cfc2",
            "website": "https://google.com/",
            "apiBaseUrl": "https://churchapp.nzian.xyz",
            "pastorName": "Misba",
            "pastorEmail": "misba.home@gmail.com",
            "pushnotification": "on",
            "showcalendar": "on",
            "broadcastmessaging": "on",
            "messaging": "on",
            "showsocialmedia": "on",
            "facebook": "https://facebook.com/devnzian",
            "instagram": "https://instagram.com/devnzian",
            "youtube": "https://youtube.com/@devnzian",
            "x": "https://twitter.com/devnzian",
            "googlemaps": "https://www.google.com/maps/place/Christian+Family+Church+International/@-26.1336799,28.2643593,17z/data=!3m1!4b1!4m6!3m5!1s0x1e9515c6bc53aa1f:0x1e7a93328a02e1ff!8m2!3d-26.1336848!4d28.2692302!16s%2Fg%2F1hd_dhjqp?entry=ttu"
            }', true);
    }

    public function getCfc2ConfigData(): array  {
        return  json_decode('{
            "version": "0.0.1",
            "churchName": "cfc3",
            "website": "https://facebook.com/",
            "apiBaseUrl": "https://churchapp.nzian.xyz",
            "pastorName": "Oliver",
             "pastorEmail": "oliver90@gmail.com",
             "pushnotification": "on",
             "showcalendar": "on",
             "broadcastmessaging": "on",
             "messaging": "on",
             "showsocialmedia": "on",
             "facebook": "https://facebook.com/devnzian",
             "instagram": "https://instagram.com/devnzian",
             "youtube": "https://youtube.com/@devnzian",
             "x": "https://twitter.com/devnzian",
             "googlemaps": "https://www.google.com/maps/place/Christian+Family+Church+International/@-26.1336799,28.2643593,17z/data=!3m1!4b1!4m6!3m5!1s0x1e9515c6bc53aa1f:0x1e7a93328a02e1ff!8m2!3d-26.1336848!4d28.2692302!16s%2Fg%2F1hd_dhjqp?entry=ttu"
           }', true);
     }
}