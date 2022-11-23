<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader\Rules;
use Core\Modules\DocumentUploader\Requests\Request;
use Core\Modules\DocumentUploader\Exceptions\WrongUfException;

class UFValidationRule
{
    private $ufTable = array(
        'RO' => '11', 'AC' => '12', 'AM' => '13',
        'RR' => '14', 'PA' => '15', 'AP' => '16',
        'TO' => '17', 'MA' => '21', 'PI' => '22',
        'CE' => '23', 'RN' => '24', 'PB' => '25',
        'PE' => '26', 'AL' => '27', 'SE' => '28',
        'BA' => '29', 'MG' => '31', 'ES' => '32',
        'RJ' => '33', 'SP' => '35', 'PR' => '41',
        'SC' => '42', 'RS' => '43', 'MS' => '50',
        'MT' => '51', 'GO' => '52', 'DF' => '53'
    );

    public function apply(Request $request, string $accessKey) {
        $bodyUF = $this->ufTable[$request->getBody()->getUF()];
        $accessKeyUF = substr($accessKey, 0, 2);

        if ($bodyUF != $accessKeyUF) {
            throw new WrongUfException("UF informada não corresponde à UF da chave de acesso do XML");
        }
    }
}

?>