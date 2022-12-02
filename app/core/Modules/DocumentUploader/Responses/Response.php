<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Responses;

use Core\Modules\DocumentUploader\Entities\DFe;

class Response
{
    private int $statusCode;
    private string $statusMessage;

    public function __construct(int $statusCode, string $statusMessage) {
        $this->statusCode = $statusCode;
        $this->statusMessage = $statusMessage;
    }

    public function getStatusCode() : int {
        return $this->statusCode;
    }

    public function getStatusMessage() : string {
        return $this->statusMessage;
    }
}
?>