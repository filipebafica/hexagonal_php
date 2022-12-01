<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Entities;

use Core\Modules\DocumentUploader\Exceptions\MissingFieldException;

class XML
{
    private $xml;

    public function __construct() {
        $this->xml = "";
    }

    public function getXML() : string {
        return $this->xml;
    }

    public function setXML(string $xml) : void {
        $this->xml = $xml;
    }
}
?>