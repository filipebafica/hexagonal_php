<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Gateways;

use Core\Modules\DocumentUploader\Entities\DocumentError;

interface DocumentErrorSaveGateWay
{
    public function save(DocumentError $documentError) : void;
}
?>