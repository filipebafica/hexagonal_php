<?php

namespace Core\Modules\DocumentUploader\Exceptions;

class WrongCNPJException extends \Exception
{
    public function __construct()
    {
        $this->message = "CNPJ informado não corresponde ao CNPJ da chave de acesso do XML";
        $this->code = "400";
    }
}
?>