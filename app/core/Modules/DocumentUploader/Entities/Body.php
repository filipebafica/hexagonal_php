<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Entities;

use Core\Modules\DocumentUploader\Exceptions\MissingBodyFieldException;

class Body
{
    private $xml;
    private $cnpj;
    private $uf;
    private $type;

    public function __construct(string $body) {
        $bodyObj = json_decode($body);
        if (!isset(
            $bodyObj->xml,
            $bodyObj->cnpj,
            $bodyObj->uf,
            $bodyObj->type
        )) {
            throw new MissingBodyFieldException("Um ou mais campos do body estão faltando");
        }
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