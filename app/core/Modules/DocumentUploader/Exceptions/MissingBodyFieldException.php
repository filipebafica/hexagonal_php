<?php

namespace Core\Modules\DocumentUploader\Exceptions;

class MissingBodyFieldException extends \Exception
{
    public function __construct()
    {
        $this->message = "Um ou mais campos do body estão faltando";
        $this->code = "400";
    }
}
?>