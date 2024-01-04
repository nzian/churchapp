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

    public function updateSocialLinkConfig(string $social): void {
        $config = $this->getConfigData();
        
        $updated_data = json_decode($social, true);
        if(isset($updated_data['x']) && $updated_data['x'] !=='') {
            $config['x'] = $updated_data['x'];
           // echo $config['x'];exit;
        }

        if(isset($updated_data['facebook']) && $updated_data['facebook'] !=='') {
            $config['facebook'] = $updated_data['facebook'];
        }
        if(isset($updated_data['instagram']) && $updated_data['instagram'] !=='') {
            $config['instagram'] = $updated_data['instagram'];
        }
        if(isset($updated_data['youtube']) && $updated_data['youtube'] !=='') {
            $config['youtube'] = $updated_data['youtube'];
        }
        if(isset($updated_data['googlemaps']) && $updated_data['googlemaps'] !=='') {
            $config['googlemaps'] = $updated_data['googlemaps'];
        }
        $result = $this->updateConfigData($config);
        
//print_r($result);die();

    }

    public function getSocialLinkFromConfig() : array {
        $config = $this->getConfigData();
        $social = [];
        if($config['x'] !=='') {
            $social['x'] = $config['x'];
        }

        if($config['facebook'] !=='') {
            $social['facebook'] = $config['facebook'];
        }
        if($config['instagram'] !=='') {
            $social['instagram'] = $config['instagram'];
        }
        if($config['youtube'] !=='') {
            $social['youtube'] = $config['youtube'];
        }
        if($config['googlemaps'] !=='') {
            $social['googlemaps'] = $config['googlemaps'];
        }
        return $social;
    }

    public function updateConfigData(array $data) : array {
        $file_path = dirname(dirname(dirname(__FILE__))) . getenv('CONFIG_FILE');
        $encrypt_key_location = dirname(dirname(dirname(__FILE__)))  . getenv('ENCRYPT_KEY_FILE') ?? dirname(dirname(dirname(__FILE__))) . '/key/encrypt.key';
        if(file_exists($file_path) && file_exists($encrypt_key_location)) {
            $key = unserialize(file_get_contents($encrypt_key_location));
            $ciphertext = Crypto::encrypt(json_encode($data), $key);
            file_put_contents($file_path, $ciphertext);
            $config = Crypto::decrypt(file_get_contents($file_path), $key);
            return json_decode($config, true);
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