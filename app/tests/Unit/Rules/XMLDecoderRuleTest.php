<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Modules\DocumentUploader\Rules\XMLDecoderRule;

class XMLDecoderRuleTest extends TestCase
{
    public function testSuccess()
    {
        $base64XML = file_get_contents("tests/Unit/base64XMLSuccess");

        $xmlDecoderRule = new XMLDecoderRule();
        $this->assertNotFalse($xmlDecoderRule->apply($base64XML));
    }

    public function testFailure()
    {
        $base64XML = file_get_contents("tests/Unit/base64XMLFailure");

        $xmlDecoderRule = new XMLDecoderRule();
        $this->assertFalse($xmlDecoderRule->apply($base64XML));
    }
}
