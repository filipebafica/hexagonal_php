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

        $body = json_encode(array(
            "xml" => "MzUyMjExOTE0MTMyODIwMDAxMDQ1NTAwNTAwMDMxODgzODEwNDE0NTEyNjY=",
            "cnpj" => "91413282000104",
            "uf" => "SP",
            "type" => "nfe"
        ));
        $accessKey = "35221191413282000104550050003188381041451266";

        $request = new Request($body);
        $cnpjValidationRule = new CNPJValidationRule();

        $cnpjValidationRule->apply($request, $accessKey);
    }

    public function testFailure() : void {
        $this->expectException(WrongCNPJException::class);

        $body = json_encode(array(
            "xml" => "MzUyMjExOTE0MTMyODIwMDAxMDQ1NTAwNTAwMDMxODgzODEwNDE0NTEyNjY=",
            "cnpj" => "91413282000104",
            "uf" => "SP",
            "type" => "nfe"
        ));
        $accessKey = "35221100000000000000550050003188381041451266";

        $request = new Request($body);
        $cnpjValidationRule = new CNPJValidationRule();

        $cnpjValidationRule->apply($request, $accessKey);
    }
}
?>