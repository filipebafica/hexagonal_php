<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Modules\DocumentUploader\Requests\Request;
use Core\Modules\DocumentUploader\Rules\XMLDecoderRule;
use Core\Modules\DocumentUploader\Exceptions\XMLDecoderException;

class XMLDecoderRuleTest extends TestCase
{
    public function testSuccess() {
        $bodyXML = "MzUyMjExOTE0MTMyODIwMDAxMDQ1NTAwNTAwMDMxODgzODEwNDE0NTEyNjY=";
        $xmlDecoderRule = new XMLDecoderRule();
        $this->assertNotFalse($xmlDecoderRule->apply($bodyXML));
    }

    public function testFailure() {
        $this->expectException(XMLDecoderException::class);
        $bodyXML = "@@@MzUyMjExOTE0MTMyODIwMDAxMDQ1NTAwNTAwMDMxODgzODEwNDE0NTEyNjY=";
        $xmlDecoderRule = new XMLDecoderRule();
        $xmlDecoderRule->apply($bodyXML);
    }
}
?>