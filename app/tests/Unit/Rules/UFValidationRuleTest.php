<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Modules\DocumentUploader\Requests\Request;
use Core\Modules\DocumentUploader\Rules\UFValidationRule;
use Core\Modules\DocumentUploader\Exceptions\WrongUFException;

class UFValidationRuleTest extends TestCase
{
    public function testSuccess() : void {
        $this->expectNotToPerformAssertions();
        $bodyUF = "SP";
        $extractedAccessKey = "35221191413282000104550050003188381041451266";
        $ufValidationRule = new UFValidationRule();
        $ufValidationRule->apply($bodyUF, $extractedAccessKey);
    }

    public function testFailure() : void {
        $this->expectException(WrongUFException::class);
        $bodyUF = "SP";
        $extractedAccessKey = "00221191413282000104550050003188381041451266";
        $ufValidationRule = new UFValidationRule();
        $ufValidationRule->apply($bodyUF, $extractedAccessKey);
    }
}
?>