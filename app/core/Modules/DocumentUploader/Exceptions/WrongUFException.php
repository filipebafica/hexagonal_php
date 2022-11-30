<?php

namespace Core\Modules\DocumentUploader\Exceptions;

class WrongUFException extends \Exception
{
    public function __construct()
    {
        $this->message = "UF informada não corresponde à UF da chave de acesso do XML";
        $this->code = 400;
    }
}
?>