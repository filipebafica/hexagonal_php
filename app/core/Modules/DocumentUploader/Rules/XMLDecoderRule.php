<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Rules;

use Core\Modules\DocumentUploader\Requests\Request;
use Core\Modules\DocumentUploader\Exceptions\XMLDecoderException;

class XMLDecoderRule
{
    public function apply(string $xml) : string|bool {
        $xml = base64_decode(
            $xml,
            true
        );

        if ($xml == false)
            throw new XMLDecoderException();
        return $xml;
    }
}
?>