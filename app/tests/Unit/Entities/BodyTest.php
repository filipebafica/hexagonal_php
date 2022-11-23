<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Modules\DocumentUploader\Entities\Body;
use Core\Modules\DocumentUploader\Exceptions\MissingBodyFieldException;

class BodyTest extends TestCase
{
    public function testSuccess() : void {
        $this->expectNotToPerformAssertions();
        $body = json_encode(array(
            "xml" => "MzUyMjExOTE0MTMyODIwMDAxMDQ1NTAwNTAwMDMxODgzODEwNDE0NTEyNjY=",
            "cnpj" => "91413282000104",
            "uf" => "SP",
            "type" => "nfe"
        ));

        new Body($body);
    }

    public function testFailure() : void {
        $this->expectException(MissingBodyFieldException::class);
        $body = json_encode(array(
            "key" => "value",
        ));

        new Body($body);
    }
}
