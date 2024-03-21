<?php

namespace App\Validator;

use App\Traits\ConfigData;
final class ConfigDataValidator {
    use ConfigData;
    private  $data = [];
    public function __construct()
    {
        $this->data = $this->getQrCodes();
    }

    public function isValidQrCode($code = NULL) {
        if($code !== NULL) {
            foreach($this->data as $qrcode) {
                if($qrcode['codeText'] == $code) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }


}