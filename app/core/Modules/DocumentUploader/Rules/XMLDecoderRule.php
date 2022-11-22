<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Rules;

class XMLDecoderRule
{
    public function apply(string $xml) : string|bool {
        return base64_decode($xml, true);
    }
}
?>