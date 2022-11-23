<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Rules;

use Core\Modules\DocumentUploader\Requests\Request;

class XMLDecoderRule
{
    public function apply(Request $request) : string|bool {
        return base64_decode(
            $request->getBody()->getXML(),
            true
        );
    }
}
?>