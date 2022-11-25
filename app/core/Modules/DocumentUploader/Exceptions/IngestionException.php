<?php

namespace Core\Modules\DocumentUploader\Exceptions;

class IngestionException extends \Exception
{
    public function __construct()
    {
        $this->message = "Ocorreu algum problema ao solicitar a ingestão do XML. Favor tentar novamente";
        $this->code = "400";
    }
}
?>