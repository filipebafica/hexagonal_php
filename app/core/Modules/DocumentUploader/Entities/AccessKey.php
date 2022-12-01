<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Entities;

use Core\Modules\DocumentUploader\Exceptions\MissingFieldException;

class AccessKey
{
    private $accessKey;

    public function __construct() {
        $this->accessKey = "";
    }

    public function getAccessKey() : string {
        return $this->accessKey;
    }

    public function setAccessKey(string $accessKey) : void {
        $this->accessKey = $accessKey;
    }
}
?>