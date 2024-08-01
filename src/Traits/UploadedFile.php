<?php

declare(strict_types=1);

namespace App\Traits;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UploadedFileInterface;

trait UploadedFile
{
    public function uploadedFileProcess(Request $inputs): Request 
    {
        $upload_dir = dirname(dirname(dirname(__FILE__))) . '/public/uploads';
        if(!empty($inputs->getUploadedFiles())) {
            $images = $inputs->getUploadedFiles();
            $single_image = $images['image'];
            if ($single_image->getError() === UPLOAD_ERR_OK) {
                $filename = $this->moveUploadedFile($upload_dir, $single_image);
                $inputs->image = getenv('APP_BASE_URL') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename;
            }
        }
        return $inputs;

    }
    public function moveUploadedFile(string $directory, UploadedFileInterface $uploadedFile)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    
        // see http://php.net/manual/en/function.random-bytes.php
        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%0.8s', $basename, $extension);
    
        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
    
        return $filename;
    }
}