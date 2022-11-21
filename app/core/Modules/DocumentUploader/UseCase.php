<?php

declare(strict_types=1);

namespace Core\Modules\DocumentUploader;

final class UseCase {
    private XMLDecoderRule $xmlDecoderRule;
    private AccessKeyRecoveryRule $accessKeyRecoveryRule;
    private CNPJValidationRule $cnpjValidationRule;
    private UFValidationRule $ufValidationRule;
    private XMLIngestorDispatchRule $xmlIngestorDispatchRule;
    private DocumentSaveRule $documentSaveRule;
    private DocumentErrorSaveRule $documentErrorSaveRule;

    public function __construct(
    ) {
        $this->xmlDecoderRule = new XMLDecoderRule();
        $this->accessKeyRecoveryRule = new AccessKeyRecoveryRule();
        $this->cnpjValidationRule = new CNPJValidationRule();
        $this->ufValidationRule = new UFValidationRule();
        $this->xmlIngestorDispatchRule = new XMLIngestorDispatchRule();
        $this->documentSaveRule = new DocumentSaveRule();
        $this->documentErrorSaveRule = new DocumentErrorSaveRule();
    }

    public function execute(Request $request) : Response {
        try {
            $xml = $this->xmlDecoderRule->apply($request);
            $accessKey = $this->accessKeyRecoveryRule->apply($xml);
            $this->cnpjValidationRule->apply($request, $accessKey);
            $this->ufValidationRule->apply($request, $accessKey);
            $this->xmlIngestorDispatchRule->apply($xml);
            $statusCode = $this->documentSaveRule->apply($xml);
        } catch (Exception $e) {
            $statusCode = $this->documentErrorSaveRule->apply($xml, $e->getMessage());
        }

        $response = new Response(
            statusCode: $statusCode
        );

        return ($response);
    }
}
?>