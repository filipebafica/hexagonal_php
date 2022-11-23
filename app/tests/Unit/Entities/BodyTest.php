<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Modules\DocumentUploader\Entities\Body;
use Core\Modules\DocumentUploader\Exceptions\MissingBodyFieldException;

class BodyTest extends TestCase
{
    public function testException() : void {
        $this->expectException(MissingBodyFieldException::class);
        $body = json_encode(array(
            "key" => "value",
        ));

        new Body($body);
    }
}
