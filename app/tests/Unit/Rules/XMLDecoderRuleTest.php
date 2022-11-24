<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Modules\DocumentUploader\Requests\Request;
use Core\Modules\DocumentUploader\Rules\XMLDecoderRule;
use Core\Modules\DocumentUploader\Exceptions\XMLDecoderException;

class XMLDecoderRuleTest extends TestCase
{
    public function testSuccess() {
        $body = json_encode(array(
            "xml" => "MzUyMjExOTE0MTMyODIwMDAxMDQ1NTAwNTAwMDMxODgzODEwNDE0NTEyNjY=",
            "cnpj" => "91413282000104",
            "uf" => "SP",
            "type" => "nfe"
        ));

        $request = new Request($body);
        $xmlDecoderRule = new XMLDecoderRule();

        $this->assertNotFalse($xmlDecoderRule->apply($request));
    }

    public function testFailure() {
        $this->expectException(XMLDecoderException::class);
        $body = json_encode(array(
            "xml" => "@@@MzUyMjExOTE0MTMyODIwMDAxMDQ1NTAwNTAwMDMxODgzODEwNDE0NTEyNjY=",
            "cnpj" => "91413282000104",
            "uf" => "SP",
            "type" => "nfe"
        ));

        $request = new Request($body);
        $xmlDecoderRule = new XMLDecoderRule();

        $xmlDecoderRule->apply($request);
    }
}
?>