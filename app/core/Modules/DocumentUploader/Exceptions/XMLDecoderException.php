<?php

namespace Core\Modules\DocumentUploader\Exceptions;

class XMLDecoderException extends \Exception
{
    public function __construct()
    {
        $this->message = "Ocorreu algum problema ao decodificar o XML passado";
        $this->code = 400;
    }
}
?>