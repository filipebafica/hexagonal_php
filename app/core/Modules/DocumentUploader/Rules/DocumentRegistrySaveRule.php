<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Rules;

use Core\Modules\DocumentUploader\Gateways\DocumentSaveGateway;
use Core\Modules\DocumentUploader\Entities\Document;

class DocumentRegistrySaveRule
{
    public function apply(
        DocumentSaveGateway $documentSaveGateway,
        Document $document
    ) : void
    {
        $documentSaveGateway->save($document);
    }
}
?>