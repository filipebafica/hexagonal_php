<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Entities;

use Core\Modules\DocumentUploader\Entities\Body;

class Document
{
    private $id;
    private $cnpj;
    private $uf;
    private $type;
    private $access_key;
    private $status;
    private $created_at;
    private $updated_at;

    public function __construct(Body $body, string $accessKey, string $status)
    {
        $this->id = 0;
        $this->cnpj = $body->getCNPJ();
        $this->uf = $body->getUF();
        $this->type = $body->getType();
        $this->accessKey = $accessKey;
        $this->status = $status;
        $this->created_at = date('m/d/Y h:i:s a');
        $this->updated_at = "n/a";
    }

    public function getID() : string{
        return $this->id;
    }

    public function getCNPJ() : string{
        return $this->cnpj;
    }

    public function getuf() : string{
        return $this->uf;
    }

    public function getType() : string {
        return $this->type;
    }

    public function getAccessKey() : string{
        return $this->access_key;
    }

    public function getStatus() : string{
        return $this->status;
    }

    public function getCreatedAt() : string{
        return $this->created_at;
    }

    public function getUpdatedAt() : string{
        return $this->updated_at;
    }
}
?>