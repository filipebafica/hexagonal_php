<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Gateways;

use Core\Modules\DocumentUploader\Entities\Document;

interface DocumentSaveGateWay
{
    public function save(Document $document) : void;
}
?>