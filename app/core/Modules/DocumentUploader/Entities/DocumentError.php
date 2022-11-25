<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Entities;

class DocumentError
{
    private string $document_id;
    private string $description;
    private string $trace;
    private string $created_at;

    public function __construct(
        string $document_id,
        string $description,
        string $trace,
    )
    {
        $this->document_id = $document_id;
        $this->description = $description;
        $this->trace = $trace;
        $this->created_at = date('m/d/Y h:i:s a');
    }

    public function getDocumentID() : string {
        return $this->document_id;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function getTrace() : string {
        return $this->trace;
    }

    public function getCreatedAt() : string {
        return $this->created_at;
    }
}
?>