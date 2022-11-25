<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Rules;

use Core\Modules\DocumentUploader\Gateways\DocumentErrorSaveGateway;
use Core\Modules\DocumentUploader\Entities\DocumentError;

class DocumentErrorRegistrySaveRule
{
    private DocumentErrorSaveGateway $documentErrorSaveGateway;
    private DocumentError $documentError;

    public function __construct(
        DocumentErrorSaveGateway $documentErrorSaveGateway,
        DocumentError $documentError
    ) {
        $this->documentErrorSaveGateway = $documentErrorSaveGateway;
        $this->documentError = $documentError;
    }

    public function apply() : void {
        $this->documentErrorSaveGateway->save($this->documentError);
    }
}

?>