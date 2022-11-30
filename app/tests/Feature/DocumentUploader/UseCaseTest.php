<?php

namespace Tests\Feature\DocumentUploader;

use PHPUnit\Framework\TestCase;
use Core\Modules\DocumentUploader\UseCase;
use Core\Modules\DocumentUploader\Adapters\DocumentSaveAdapter;
use Core\Modules\DocumentUploader\Adapters\DocumentErrorSaveAdapter;
use Core\Modules\DocumentUploader\Entities\Body;
use Core\Modules\DocumentUploader\Requests\Request;

class UseCaseTest extends TestCase
{
    public function testSuccess() : void {
        $this->expectNotToPerformAssertions();
        $body = json_encode(array(
            "xml" => "MzUyMjExOTE0MTMyODIwMDAxMDQ1NTAwNTAwMDMxODgzODEwNDE0NTEyNjY=",
            "cnpj" => "91413282000104",
            "uf" => "SP",
            "type" => "nfe"
        ));

        $useCase = new UseCase(
            new DocumentSaveAdapter(),
            new DocumentErrorSaveAdapter()
        );

        $request = new Request($body);
        $useCase->execute($request);
    }

    public function testFailure() : void {
        $this->expectException(\Exception::class);
        $body = json_encode(array(
            "xml" => "MzUyMjExOTE0MTMyODIwMDAxMDQ1NTAwNTAwMDMxODgzODEwNDE0NTEyNjY=",
            "cnpj" => "00000000000000",
            "uf" => "SP",
            "type" => "nfe"
        ));

        $useCase = new UseCase(
            new DocumentSaveAdapter(),
            new DocumentErrorSaveAdapter()
        );

        $request = new Request($body);
        $useCase->execute($request);
    }
}
