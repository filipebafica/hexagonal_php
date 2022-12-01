<?php
declare(strict_types=1);

namespace Core\Modules\DocumentUploader;

use Core\Modules\DocumentUploader\Rules\XMLDecoderRule;
use Core\Modules\DocumentUploader\Rules\AccessKeyRecoveryRule;
use Core\Modules\DocumentUploader\Rules\CNPJValidationRule;
use Core\Modules\DocumentUploader\Rules\UFValidationRule;
use Core\Modules\DocumentUploader\Rules\XMLIngestorDispatchRule;
use Core\Modules\DocumentUploader\Entities\Document;
use Core\Modules\DocumentUploader\Entities\DocumentError;
use Core\Modules\DocumentUploader\Entities\XML;
use Core\Modules\DocumentUploader\Entities\AccessKey;
use Core\Modules\DocumentUploader\Gateways\DocumentSaveGateway;
use Core\Modules\DocumentUploader\Gateways\DocumentErrorSaveGateway;
use Core\Modules\DocumentUploader\Requests\Request;

final class UseCase
{
    private XMLDecoderRule $xmlDecoderRule;
    private AccessKeyRecoveryRule $accessKeyRecoveryRule;
    private CNPJValidationRule $cnpjValidationRule;
    private UFValidationRule $ufValidationRule;
    private XMLIngestorDispatchRule $xmlIngestorDispatchRule;
    private XML $xml;
    private AccessKey $accessKey;
    private DocumentSaveGateway $documentSaveGateway;
    private DocumentErrorSaveGateway $documentErrorSaveGateway;

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
        $this->xml = new XML();
        $this->accessKey = new AccessKey();
    }

    public function execute(Request $request) : void
    {
        try {
            $this->xml->setXML(
                $this->xmlDecoderRule->apply($request->getDFe()->getXML())
            );

            $this->accessKey->setAccessKey(
                $this->accessKeyRecoveryRule->apply($this->xml->getXML())
            );

            $this->cnpjValidationRule->apply(
                $request->getDFe()->getCNPJ(),
                $this->accessKey->getAccessKey()
            );

            $this->ufValidationRule->apply(
                $request->getDFe()->getUF(),
                $this->accessKey->getAccessKey()
            );

            $this->xmlIngestorDispatchRule->apply(
                $this->xml->getXML()
            );

            $this->documentSaveGateway->save(new Document(
                $request->getDFe(),
                $this->accessKey->getAccessKey(),
                "success"
            ));

        } catch (\Exception $e) {
            $document = new Document(
                $request->getDFe(),
                $this->accessKey->getAccessKey(),
                "error"
            );

            $this->documentSaveGateway->save($document);
            $this->documentErrorSaveGateway->save(new DocumentError(
                $document->getID(),
                $e->getMessage(),
                $e->getTraceAsString()
            ));

            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
?>