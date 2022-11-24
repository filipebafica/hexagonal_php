<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Rules;
namespace Core\Modules\DocumentUploader\Exceptions\IngestionException;

class XMLIngestorDispatchRule
{
    public function apply(string $xml) : void {
        // bypass to never use this exception, since this is not a real functional Dispatch
        if (false) {
            throw new IngestionException();
        }
    }
}

?>