<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Rules;

use Core\Modules\DocumentUploader\Gateways\DocumentSaveGateway;
use Core\Modules\DocumentUploader\Entities\Document;

class DocumentRegistrySaveRule
{
    private DocumentSaveGateway $documentSaveGateway;
    private Document $document;

    public function __construct(
        DocumentSaveGateway $documentSaveGateway,
        Document $document
    ) {
        $this->documentSaveGateway = $documentSaveGateway;
        $this->document = $document;
    }

    public function apply() : void {
        $this->documentSaveGateway->save($this->document);
    }
}

?>