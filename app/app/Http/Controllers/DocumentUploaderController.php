<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentUploaderRequest;
use Core\Modules\DocumentUploader\UseCase;
use Core\Modules\DocumentUploader\Adapters\DocumentSaveAdapter;
use Core\Modules\DocumentUploader\Adapters\DocumentErrorSaveAdapter;
use Core\Modules\DocumentUploader\Requests\Request;
use Core\Modules\DocumentUploader\Responses\Response;


class DocumentUploaderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Requests\DocumentUploaderRequest;  $request
     * @return \Illuminate\Http\Response
     */

    public function upload(DocumentUploaderRequest $httpRequest)
    {
        try {
            $request = new Request(json_encode($httpRequest->all()));
            $useCase = new UseCase(
                new DocumentSaveAdapter(),
                new DocumentErrorSaveAdapter()
            );

            $response = $useCase->execute($request);
            return response(
                $response->getStatusMessage(),
                $response->getStatusCode()
            );

        } catch (\Throwable $e) {
            return response(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }
}
