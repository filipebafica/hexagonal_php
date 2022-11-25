<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Rules;

use Core\Modules\DocumentUploader\Gateways\DocumentErrorSaveGateway;
use Core\Modules\DocumentUploader\Entities\DocumentError;

class DocumentErrorRegistrySaveRule
{
    public function apply(
        DocumentErrorSaveGateway $documentErrorSaveGateway,
        DocumentError $documentError
    ) : void
    {
        $documentErrorSaveGateway->save($documentError);
    }
}

?>