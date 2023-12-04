<?php

declare(strict_types=1);

namespace App\Traits;

trait ConfigData
{
    public function getConfigData()
    {
        $file_path = dirname(dirname(dirname(__FILE__))) . getenv('CONFIG_FILE');
        if(file_exists($file_path)) {
            $config = file_get_contents($file_path);
            return json_decode($config, true);
        }
        return json_encode([]);
    }
}