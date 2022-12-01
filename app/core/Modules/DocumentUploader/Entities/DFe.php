<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Entities;

use Core\Modules\DocumentUploader\Exceptions\MissingFieldException;

class DFe
{
    private string $xml;
    private string $cnpj;
    private string $uf;
    private string $type;

    public function __construct(string $body) {
        $bodyObj = json_decode($body);
        $this->xml = $bodyObj->xml;
        $this->cnpj = $bodyObj->cnpj;
        $this->uf = $bodyObj->uf;
        $this->type = $bodyObj->type;
    }

    public function getXML() : string {
        return $this->xml;
    }

    public function getCNPJ() : string {
        return $this->cnpj;
    }

    public function getUF() : string {
        return $this->uf;
    }

    public function getType() : string {
        return $this->type;
    }
}
?>