<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Requests;

use Core\Modules\DocumentUploader\Entities\Body;

class Request
{
    private Body $body;

    public function __construct(string $body) {
        $this->body = new Body($body);
    }

    public function getBody() : Body {
        return $this->body;
    }
}
?>