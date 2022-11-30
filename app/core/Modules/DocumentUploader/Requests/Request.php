<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Requests;

use Core\Modules\DocumentUploader\Entities\DFe;

class Request
{
    private DFe $dfe;

    public function __construct(string $body) {
        $this->dfe = new DFe($body);
    }

    public function getDFe() : DFe {
        return $this->dfe;
    }
}
?>