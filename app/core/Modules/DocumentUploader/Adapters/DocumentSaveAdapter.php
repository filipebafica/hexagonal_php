<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Adapters;

use Core\Modules\DocumentUploader\Gateways\DocumentSaveGateway;
use Core\Modules\DocumentUploader\Entities\Document;

class DocumentSaveAdapter extends DocumentSaveGateway
{
    public function save(Document $document) : void {}
}

?>