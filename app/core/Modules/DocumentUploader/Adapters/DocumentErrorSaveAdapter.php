<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Adapters;

use Core\Modules\DocumentUploader\Gateways\DocumentErrorSaveGateway;
use Core\Modules\DocumentUploader\Entities\DocumentError;

class DocumentErrorSaveAdapter implements DocumentErrorSaveGateway
{
    public function save(DocumentError $documentError) : void {}
}

?>