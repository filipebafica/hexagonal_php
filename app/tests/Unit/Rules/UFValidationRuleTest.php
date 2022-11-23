<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Modules\DocumentUploader\Requests\Request;
use Core\Modules\DocumentUploader\Rules\UFValidationRule;
use Core\Modules\DocumentUploader\Exceptions\WrongUfException;

class UFValidationRuleTest extends TestCase
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
        $UFValidationRule = new UFValidationRule();

        $UFValidationRule->apply($request, $accessKey);
    }

    public function testFailure() : void {
        $this->expectException(WrongUfException::class);

        $body = json_encode(array(
            "xml" => "MzUyMjExOTE0MTMyODIwMDAxMDQ1NTAwNTAwMDMxODgzODEwNDE0NTEyNjY=",
            "cnpj" => "91413282000104",
            "uf" => "SP",
            "type" => "nfe"
        ));
        $accessKey = "00221191413282000104550050003188381041451266";

        $request = new Request($body);
        $UFValidationRule = new UFValidationRule();

        $UFValidationRule->apply($request, $accessKey);
    }
}
?>