<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Rules;

class AccessKeyRecoveryRule
{
    public function apply(string $xml) : string {
        return $xml;
    }
}

?>