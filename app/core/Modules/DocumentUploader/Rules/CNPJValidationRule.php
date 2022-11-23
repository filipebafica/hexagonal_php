<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Rules;
use Core\Modules\DocumentUploader\Requests\Request;
use Core\Modules\DocumentUploader\Exceptions\WrongCNPJException;

class CNPJValidationRule
{
    public function apply(Request $request, string $accessKey) {
        $bodyCNPJ = $request->getBody()->getCNPJ();
        $accessKeyCNPJ = substr($accessKey, 6, 14);

        if ($bodyCNPJ != $accessKeyCNPJ) {
            throw new WrongCNPJException("CNPJ informado não corresponde ao CNPJ da chave de acesso do XML");
        }
    }
}
?>