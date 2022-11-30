<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Entities;

use Core\Modules\DocumentUploader\Entities\DFe;

class Document
{
    private string $id;
    private string $cnpj;
    private string $uf;
    private string $type;
    private string $access_key;
    private string $status;
    private string $created_at;
    private string $updated_at;

    public function __construct(DFe $dfe, string $accessKey, string $status)
    {
        $this->id = "0";
        $this->cnpj = $dfe->getCNPJ();
        $this->uf = $dfe->getUF();
        $this->type = $dfe->getType();
        $this->accessKey = $accessKey;
        $this->status = $status;
        $this->created_at = date('m/d/Y h:i:s a');
        $this->updated_at = "n/a";
    }

    public function getID() : string {
        return $this->id;
    }

    public function getCNPJ() : string {
        return $this->cnpj;
    }

    public function getuf() : string {
        return $this->uf;
    }

    public function getType() : string {
        return $this->type;
    }

    public function getAccessKey() : string {
        return $this->access_key;
    }

    public function getStatus() : string {
        return $this->status;
    }

    public function getCreatedAt() : string {
        return $this->created_at;
    }

    public function getUpdatedAt() : string {
        return $this->updated_at;
    }
}
?>