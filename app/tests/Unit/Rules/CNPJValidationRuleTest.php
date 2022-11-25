<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Modules\DocumentUploader\Requests\Request;
use Core\Modules\DocumentUploader\Rules\CNPJValidationRule;
use Core\Modules\DocumentUploader\Exceptions\WrongCNPJException;

class CNPJValidationRuleTest extends TestCase
{
    public function testSuccess() : void {
        $this->expectNotToPerformAssertions();
        $bodyCNPJ = "91413282000104";
        $extractedAccessKey = "35221191413282000104550050003188381041451266";
        $cnpjValidationRule = new CNPJValidationRule();
        $cnpjValidationRule->apply($bodyCNPJ, $extractedAccessKey);
    }

    public function testFailure() : void {
        $this->expectException(WrongCNPJException::class);
        $bodyCNPJ = "91413282000104";
        $extractedAccessKey = "35221100000000000000550050003188381041451266";
        $cnpjValidationRule = new CNPJValidationRule();
        $cnpjValidationRule->apply($bodyCNPJ, $extractedAccessKey);
    }
}
?>