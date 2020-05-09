<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Fulfilment;


use Sdk\ApiClient\CDSApiClient;
use Sdk\Exception\InvalidDataResponseException;
use Sdk\Exception\ResponseErrorException;
use Sdk\HttpTools\CDSApiSoapRequest;
use Sdk\Soap\Common\Body;
use Sdk\Soap\Common\Envelope;
use Sdk\Soap\Fulfilment\CreateExternalOrderSoap;
use Sdk\Soap\Fulfilment\GetExternalOrderStatusSoap;
use Sdk\Soap\Fulfilment\Response\CreateExternalOrderResponse;
use Sdk\Soap\Fulfilment\Response\GetExternalOrderStatusResponse;
use Sdk\Soap\Fulfilment\GetFulfilmentActivationReportListSoap;
use Sdk\Soap\Fulfilment\GetFulfilmentDeliveryDocumentSoap;
use Sdk\Soap\Fulfilment\GetFulfilmentOrderListToSupplySoap;
use Sdk\Soap\Fulfilment\GetFulfilmentSupplyOrderReportListSoap;
use Sdk\Soap\Fulfilment\GetFulfilmentSupplyOrderSoap;
use Sdk\Soap\Fulfilment\GetProductStockListSoap;
use Sdk\Soap\Fulfilment\Response\FulfilmentSupplyOrderReportListResponse;
use Sdk\Soap\Fulfilment\Response\GetFulfilmentActivationReportRequestXmlResponse;
use Sdk\Soap\Fulfilment\Response\GetFulfilmentDeliveryDocumentResponse;
use Sdk\Soap\Fulfilment\Response\GetFulfilmentOrderListToSupplyResponse;
use Sdk\Soap\Fulfilment\Response\GetFulfilmentSupplyOrderResponse;
use Sdk\Soap\Fulfilment\Response\GetProductStockListResponse;
use Sdk\Soap\Fulfilment\Response\SubmitFulfilmentActivationResponse;
use Sdk\Soap\Fulfilment\Response\SubmitFulfilmentOnDemandSupplyOrderResponse;
use Sdk\Soap\Fulfilment\Response\SubmitFulfilmentSupplyOrderResponse;
use Sdk\Soap\Fulfilment\Response\SubmitOfferStateActionResponse;
use Sdk\Soap\Fulfilment\SubmitFulfilmentActivationSoap;
use Sdk\Soap\Fulfilment\SubmitFulfilmentOnDemandSupplyOrderSoap;
use Sdk\Soap\Fulfilment\SubmitFulfilmentSupplyOrderSoap;
use Sdk\Soap\Fulfilment\SubmitOfferStateActionSoap;
use Sdk\Soap\HeaderMessage\HeaderMessage;

/*
 * Fulfilment point
 */

class FulfilmentPoint
{
    public function __construct()
    {
    }

    /*
     * @param $offerStateActionRequest \Sdk\Fulfilment\OfferStateActionRequest
     * @return $submitOfferStateActionResponse
     */
    public function SubmitOfferStateAction($offerStateActionRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace('xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $submitOfferStateAction = new SubmitOfferStateActionSoap();

        $headerXml = $header->generateHeader();
        $offerStateActionRequestXml = $submitOfferStateAction->generateofferStateActionRequestXml(
            $offerStateActionRequest
        );

        $submitOfferStateActionXml = $submitOfferStateAction->generateEnclosingBalise(
            $headerXml.$offerStateActionRequestXml
        );

        $bodyXml = $body->generateXML($submitOfferStateActionXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('SubmitOfferStateAction', $envelopeXml);

        return new SubmitOfferStateActionResponse($response);
    }

    /**
     * @param $orderStatusRequest
     * @return GetExternalOrderStatusResponse
     * @throws InvalidDataResponseException
     * @throws ResponseErrorException
     */
    public function GetExternalOrderStatus($orderStatusRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $getExternalOrderStatus = new GetExternalOrderStatusSoap();
        $headerXml = $header->generateHeader();
        $orderStatusRequestXml = $getExternalOrderStatus->generateOrderStatusRequestXml($orderStatusRequest);
        $getExternalOrderStatusXml = $getExternalOrderStatus->generateEnclosingBalise(
            $headerXml.$orderStatusRequestXml
        );
        $bodyXml = $body->generateXML($getExternalOrderStatusXml);
        $envelopeXml = $envelope->generateXML($bodyXml);
        $response = $this->_sendRequest('GetExternalOrderStatus', $envelopeXml);

        return new GetExternalOrderStatusResponse($response);
    }

    /*
    * @param $orderIntegrationRequest \Sdk\Fulfilment\orderIntegrationRequest
    * @return $createExternalOrderResponse
    */
    public function CreateExternalOrder($orderIntegrationRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $createExternalOrderSoap = new CreateExternalOrderSoap();
        $headerXml = $header->generateHeader();
        $orderIntegrationRequestXml = $createExternalOrderSoap->generateFulfillmentProductRequestXml(
            $orderIntegrationRequest
        );
        $createExternalOrderXml = $createExternalOrderSoap->generateEnclosingBalise(
            $headerXml.$orderIntegrationRequestXml
        );
        $bodyXml = $body->generateXML($createExternalOrderXml);
        $envelopeXml = $envelope->generateXML($bodyXml);
        $response = $this->_sendRequest('CreateExternalOrder', $envelopeXml);

        return new CreateExternalOrderResponse($response);
    }

    /*
    * @param $fulfilmentOnDemandOrderLineRequest \Sdk\Fulfilment\FulfilmentOnDemandOrderLineFilter
    * @return $getFulfilmentOrderListToSupplyResponse \Sdk\Soap\Fulfilment\Response\GetFulfilmentOrderListToSupplyResponse
    */
    public function GetFulfilmentOrderListToSupply($fulfilmentOnDemandOrderLineRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();

        $getFulfilmentOrderListToSupply = new GetFulfilmentOrderListToSupplySoap();

        $headerXml = $header->generateHeader();
        $fulfilmentOnDemandOrderLineRequestXml = $getFulfilmentOrderListToSupply->generateFulfilmentOnDemandOrderLineRequestXml(
            $fulfilmentOnDemandOrderLineRequest
        );
        $getFulfilmentOrderListToSupplyXml = $getFulfilmentOrderListToSupply->generateEnclosingBalise(
            $headerXml.$fulfilmentOnDemandOrderLineRequestXml
        );

        $bodyXml = $body->generateXML($getFulfilmentOrderListToSupplyXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('GetFulfilmentOrderListToSupply', $envelopeXml);

        return new GetFulfilmentOrderListToSupplyResponse($response);
    }

    /*
    * @param $supplyOrderRequest \Sdk\Fulfilment\SupplyOrderRequest
    * @return $getFulfilmentSupplyOrderResponse \Sdk\Soap\Fulfilment\Response\GetFulfilmentSupplyOrderResponse
    */
    public function GetFulfilmentSupplyOrder($supplyOrderRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $envelope->addNameSpace(' xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"');
        $header = new HeaderMessage();
        $body = new Body();
        $getFulfilmentSupplyOrder = new GetFulfilmentSupplyOrderSoap();

        $headerXml = $header->generateHeader();
        $getFulfilmentSupplyOrderRequestXml = $getFulfilmentSupplyOrder->generateGetFulfilmentSupplyOrderRequestXml(
            $supplyOrderRequest
        );

        $getFulfilmentSupplyOrderXml = $getFulfilmentSupplyOrder->generateEnclosingBalise(
            $headerXml.$getFulfilmentSupplyOrderRequestXml
        );
        $bodyXml = $body->generateXML($getFulfilmentSupplyOrderXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('GetFulfilmentSupplyOrder', $envelopeXml);

        return new GetFulfilmentSupplyOrderResponse($response);
    }

    /*
     * @param $supplyOrderReportRequest \Sdk\Fulfilment\SupplyOrderReportRequest
     * @return $fulfilmentSupplyOrderReportListResponse \Sdk\Soap\Fulfilment\Response\FulfilmentSupplyOrderReportListResponse
     */
    public function GetFulfilmentSupplyOrderReportList($supplyOrderReportRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $envelope->addNameSpace(' xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"');
        $header = new HeaderMessage();
        $body = new Body();
        $fulfilmentSupplyReportList = new GetFulfilmentSupplyOrderReportListSoap();

        $headerXml = $header->generateHeader();
        $supplyOrderReportRequestXml = $fulfilmentSupplyReportList->generateSupplyOrderReportRequestXml(
            $supplyOrderReportRequest
        );

        $fulfilmentSupplyReportListXml = $fulfilmentSupplyReportList->generateEnclosingBalise(
            $headerXml.$supplyOrderReportRequestXml
        );

        $bodyXml = $body->generateXML($fulfilmentSupplyReportListXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('GetFulfilmentSupplyOrderReportList', $envelopeXml);

        return new FulfilmentSupplyOrderReportListResponse($response);
    }

    /*
     * @param $fulfillmentProductRequest \Sdk\Fulfilment\FulfillmentProductRequest
     * @return $getProductStockListResponse
     */
    public function GetProductStockList($fulfilmentProductRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $getProductStockList = new GetProductStockListSoap();
        $headerXml = $header->generateHeader();
        $fulfilmentProductRequestXml = $getProductStockList->generateFulfilmentProductRequestXml(
            $fulfilmentProductRequest
        );
        $getProductStockListXml = $getProductStockList->generateEnclosingBalise(
            $headerXml.$fulfilmentProductRequestXml
        );
        $bodyXml = $body->generateXML($getProductStockListXml);
        $envelopeXml = $envelope->generateXML($bodyXml);
        $response = $this->_sendRequest('GetProductStockList', $envelopeXml);

        return new GetProductStockListResponse($response);
    }

    /*
     * @param $fulfilmentSupplyOrderRequest \Sdk\Fulfilment\FulfilmentSupplyOrderRequest
     * @return $submitFulfilmentSupplyOrderResponse \Sdk\Soap\Fulfilment\Response\SubmitFulfilmentSupplyOrderResponse
     */
    public function SubmitFulfilmentSupplyOrder($fulfilmentSupplyOrderRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace('xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $submitFulfilmentSupplyOrder = new SubmitFulfilmentSupplyOrderSoap();

        $headerXml = $header->generateHeader();
        $fulfilmentSupplyOrderRequestXml = $submitFulfilmentSupplyOrder->generateFulfilmentSupplyOrderRequestXml(
            $fulfilmentSupplyOrderRequest
        );

        $submitFulfilmentSupplyOrderXml = $submitFulfilmentSupplyOrder->generateEnclosingBalise(
            $headerXml.$fulfilmentSupplyOrderRequestXml
        );

        $bodyXml = $body->generateXML($submitFulfilmentSupplyOrderXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('SubmitFulfilmentSupplyOrder', $envelopeXml);

        return new SubmitFulfilmentSupplyOrderResponse($response);
    }

    /*
     * @param $fulfilmentOnDemandSupplyOrderRequest \Sdk\Fulfilment\FulfilmentOnDemandSupplyOrderRequest
     * @return $submitFulfilmentOnDemandSupplyOrderResponse \Sdk\Soap\Fulfilment\Response\SubmitFulfilmentOnDemandSupplyOrderResponse
     */
    public function SubmitFulfilmentOnDemandSupplyOrder($fulfilmentOnDemandSupplyOrderRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $submitFulfilmentOnDemandSupplyOrder = new SubmitFulfilmentOnDemandSupplyOrderSoap();

        $headerXml = $header->generateHeader();
        $fulfilmentOnDemandSupplyOrderRequestXml = $submitFulfilmentOnDemandSupplyOrder->generateFulfilmentOnDemandSupplyOrderRequestXml(
            $fulfilmentOnDemandSupplyOrderRequest
        );
        $submitFulfilmentOnDemandSupplyOrderXml = $submitFulfilmentOnDemandSupplyOrder->generateEnclosingBalise(
            $headerXml.$fulfilmentOnDemandSupplyOrderRequestXml
        );

        $bodyXml = $body->generateXML($submitFulfilmentOnDemandSupplyOrderXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('SubmitFulfilmentOnDemandSupplyOrder', $envelopeXml);

        return new SubmitFulfilmentOnDemandSupplyOrderResponse($response);
    }

    /*
     * @param $request \Sdk\Fulfilment\SubmitFulfilmentActivationRequest
     * @return $submitFulfilmentActivationResponse
     */
    public function SubmitFulfilmentActivation($request)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $envelope->addNameSpace(
            ' xmlns:cdis1="http://schemas.datacontract.org/2004/07/Cdiscount.Framework.Core.Communication.Messages"'
        );
        $envelope->addNameSpace(
            ' xmlns:cdis2="http://schemas.datacontract.org/2004/07/Cdiscount.Service.Marketplace.API.External.Contract.Data.Fulfilment"'
        );
        $header = new HeaderMessage();
        $body = new Body();
        $submitFulfilmentActivationSoap = new SubmitFulfilmentActivationSoap();

        $headerXml = $header->generateHeader();
        $submitFulfilmentActivationquestXml = $submitFulfilmentActivationSoap->generateFulfilmentActivationRequestXml(
            $request
        );

        $getFulfilmentActivationXml = $submitFulfilmentActivationSoap->generateEnclosingBalise(
            $headerXml.$submitFulfilmentActivationquestXml
        );
        $bodyXml = $body->generateXML($getFulfilmentActivationXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('SubmitFulfilmentActivation', $envelopeXml);

        return new SubmitFulfilmentActivationResponse($response);
    }

    /*
     * @param $fulfilmentDeliveryRequest \Sdk\Fulfilment\FulfilmentDeliveryRequest
     * @return $getFulfilmentDeliveryDocumentResponse
     */
    public function GetFulfilmentDeliveryDocument($fulfilmentDeliveryRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $getFulfilmentDeliveryDocument = new GetFulfilmentDeliveryDocumentSoap();

        $headerXml = $header->generateHeader();
        $getFulfilmentDeliveryDocumentRequestXml = $getFulfilmentDeliveryDocument->generateFulfilmentDeliveryDocumentRequestXml(
            $fulfilmentDeliveryRequest
        );

        $getFulfilmentDeliveryDocumentXml = $getFulfilmentDeliveryDocument->generateEnclosingBalise(
            $headerXml.$getFulfilmentDeliveryDocumentRequestXml
        );

        $bodyXml = $body->generateXML($getFulfilmentDeliveryDocumentXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('GetFulfilmentDeliveryDocument', $envelopeXml);

        return new GetFulfilmentDeliveryDocumentResponse($response);
    }

    /*
     * @param $FulfilmentActivationReportRequest \Sdk\Fulfilment\FulfilmentActivationReportRequest
     * @return $FulfilmentActivationReportRequestXmlResponse
     */
    public function GetFulfilmentActivationReportList($FulfilmentActivationReportRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $FulfilmentActivationReportList = new GetFulfilmentActivationReportListSoap();

        $headerXml = $header->generateHeader();

        $FulfilmentActivationReportRequestXml = $FulfilmentActivationReportList->generateFulfilmentActivationReportRequestXml(
            $FulfilmentActivationReportRequest
        );

        $FulfilmentActivationReportXml = $FulfilmentActivationReportList->generateEnclosingBalise(
            $headerXml.$FulfilmentActivationReportRequestXml
        );

        $bodyXml = $body->generateXML($FulfilmentActivationReportXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('GetFulfilmentActivationReportList', $envelopeXml);

        return new GetFulfilmentActivationReportRequestXmlResponse($response);
    }

    /*
     * @param $method
     * @param $data
     * @return $response
     */
    private function _sendRequest($method, $data)
    {
        $headerRequestURL = CDSApiClient::getInstance()->getMethodUrl();

        $apiURL = CDSApiClient::getInstance()->getApiUrl();

        $request = new CDSApiSoapRequest($method, $headerRequestURL, $apiURL, $data);

        return $request->call();
    }
}
