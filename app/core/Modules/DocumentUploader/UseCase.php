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

    public function __construct(
    ) {
        $this->xmlDecoderRule = new XMLDecoderRule();
        $this->accessKeyRecoveryRule = new AccessKeyRecoveryRule();
        $this->cnpjValidationRule = new CNPJValidationRule();
        $this->ufValidationRule = new UFValidationRule();
        $this->xmlIngestorDispatchRule = new XMLIngestorDispatchRule();
        $this->documentRegistrySaveRule = new DocumentRegistrySaveRule();
        $this->documentErrorRegistrySaveRule = new DocumentErrorRegistrySaveRule();
    }

    public function execute(Request $request) : Response {
        try {
            $xml = $this->xmlDecoderRule->apply($request);
            $accessKey = $this->accessKeyRecoveryRule->apply($xml);
            $this->cnpjValidationRule->apply($request, $accessKey);
            $this->ufValidationRule->apply($request, $accessKey);
            $this->xmlIngestorDispatchRule->apply($xml);
            $statusCode = $this->documentRegistrySaveRule->apply(new Document($xml));
        } catch (Exception $e) {
            $statusCode = $this->documentErrorRegistrySaveRule->apply(new DocumentError($xml, $e->getMessage()));
        }

        $response = new Response(
            statusCode: $statusCode
        );

        return ($response);
    }
}
?>