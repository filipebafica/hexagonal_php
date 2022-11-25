<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader;

use Core\Modules\DocumentUploader\Rules\XMLDecoderRule;
use Core\Modules\DocumentUploader\Rules\AccessKeyRecoveryRule;
use Core\Modules\DocumentUploader\Rules\CNPJValidationRule;
use Core\Modules\DocumentUploader\Rules\UFValidationRule;
use Core\Modules\DocumentUploader\Rules\XMLIngestorDispatchRule;
use Core\Modules\DocumentUploader\Rules\DocumentRegistrySaveRule;
use Core\Modules\DocumentUploader\Rules\DocumentErrorRegistrySaveRule;
use Core\Modules\DocumentUploader\Entities\Document;
use Core\Modules\DocumentUploader\Entities\DocumentError;
use Core\Modules\DocumentUploader\Gateways\DocumentSaveGateway;
use Core\Modules\DocumentUploader\Gateways\DocumentErrorSaveGateway;
use Core\Modules\DocumentUploader\Requests\Request;
use Core\Modules\DocumentUploader\Responses\Response;

final class UseCase
{
    private XMLDecoderRule $xmlDecoderRule;
    private AccessKeyRecoveryRule $accessKeyRecoveryRule;
    private CNPJValidationRule $cnpjValidationRule;
    private UFValidationRule $ufValidationRule;
    private XMLIngestorDispatchRule $xmlIngestorDispatchRule;
    private DocumentRegistrySaveRule $documentRegistrySaveRule;
    private DocumentErrorRegistrySaveRule $documentErrorRegistrySaveRule;
    private DocumentSaveGateway $documentSaveGateway;
    private DocumentErrorSaveGateway $documentErrorSaveGateway;
    private string $statusCode;

    public function __construct(
        DocumentSaveGateway $documentSaveGateway,
        DocumentErrorSaveGateway $documentErrorSaveGateway

    ){
        $this->documentSaveGateway = $documentSaveGateway;
        $this->documentErrorSaveGateway = $documentErrorSaveGateway;
        $this->xmlDecoderRule = new XMLDecoderRule();
        $this->accessKeyRecoveryRule = new AccessKeyRecoveryRule();
        $this->cnpjValidationRule = new CNPJValidationRule();
        $this->ufValidationRule = new UFValidationRule();
        $this->xmlIngestorDispatchRule = new XMLIngestorDispatchRule();
        $this->documentRegistrySaveRule = new DocumentRegistrySaveRule();
        $this->documentErrorRegistrySaveRule = new DocumentErrorRegistrySaveRule();
    }

    public function execute(Request $request) : Response
    {
        try {
            $xml = $this->xmlDecoderRule->apply($request->getBody()->getXML());
            $accessKey = $this->accessKeyRecoveryRule->apply($xml);
            $this->cnpjValidationRule->apply($request->getBody()->getCNPJ(), $accessKey);
            $this->ufValidationRule->apply($request->getBody()->getUF(), $accessKey);
            $this->xmlIngestorDispatchRule->apply($xml);
            $this->documentRegistrySaveRule->apply(new Document(
                $request->getBody(),
                $accessKey,
                "success"
            ));
            $this->statusCode = 204;
        } catch (Exception $e) {
            $this->statusCode = $e->getCode();
            $document = new Document(
                $request->getBody(),
                $accessKey,
                "error"
            );
            $this->documentRegistrySaveRule->apply($documentSaveGateway, $document);
            $this->documentErrorRegistrySaveRule->apply($documentErrorSaveGateway, new DocumentError(
                $document->getID(),
                $e->getMessage(),
                $e->getTraceAsString()
            ));
        }

        $response = new Response(
            statusCode: $this->statusCode
        );

        return $response;
    }
}
?>