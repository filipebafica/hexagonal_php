<?php

namespace Tests\Feature\DocumentUploader;

use PHPUnit\Framework\TestCase;
use Core\Modules\DocumentUploader\UseCase;
use Core\Modules\DocumentUploader\Adapters\DocumentSaveAdapter;
use Core\Modules\DocumentUploader\Adapters\DocumentErrorSaveAdapter;
use Core\Modules\DocumentUploader\Entities\Body;
use Core\Modules\DocumentUploader\Requests\Request;
use Core\Modules\DocumentUploader\Responses\Response;

class UseCaseTest extends TestCase
{
    public function testSuccess() : void {
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
        $response = $useCase->execute($request);
        $this->assertSame(201, $response->getStatusCode());
    }

    public function testFailure() : void {
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
        $response = $useCase->execute($request);
        $this->assertNotSame(201, $response->getStatusCode());
    }
}
