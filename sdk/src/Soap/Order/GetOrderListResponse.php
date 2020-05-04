<?php

namespace Sdk\Soap\Order;

use Sdk\Customer\Customer;
use Sdk\Exception\InvalidDataResponseException;
use Sdk\Exception\ResponseErrorException;
use Sdk\Order\Corporation;
use Sdk\Order\Order;
use Sdk\Order\OrderLine;
use Sdk\Order\OrderLineList;
use Sdk\Order\OrderList;
use Sdk\Order\Refund\RefundInformation;
use Sdk\Order\Voucher;
use Sdk\Order\VoucherList;
use Sdk\Parcel\Parcel;
use Sdk\Parcel\ParcelItem;
use Sdk\Parcel\ParcelList;
use Sdk\Parcel\Tracking;
use Sdk\Parcel\TrackingList;
use Sdk\Seller\Address;
use Sdk\Soap\Common\AbstractResponse;
use Sdk\Soap\Common\SoapTools;
use Zend\Config\Reader\Xml;

class GetOrderListResponse extends AbstractResponse
{
    /**
     * @var array
     */
    private $dataResponse;

    /**
     * @var OrderList
     */
    private $orderList = null;

    /**
     * GetOrderListResponse constructor.
     * @param $response
     * @throws InvalidDataResponseException|ResponseErrorException
     */
    public function __construct($response)
    {
        $reader = new Xml();
        $this->dataResponse = $reader->fromString($response);

        $this->checkResponseDataValidity(
            $this->dataResponse,
            's:Body.GetOrderListResponse.GetOrderListResult'
        );

        $orderListXml = $this->dataResponse['s:Body']['GetOrderListResponse']['GetOrderListResult'];
        $this->checkErrors($orderListXml);

        $this->orderList = new OrderList();
        $this->setOrderList($orderListXml);
    }

    /**
     * @return OrderList
     */
    public function getOrderList()
    {
        return $this->orderList;
    }

    private function setOrderList($orderListXml)
    {
        $orderList = $orderListXml['OrderList'];

        if (!isset($order['OrderList'])) {
            return;
        }

        $order = $orderList['Order'];
        if (isset($order['OrderNumber'])) {
            $order = [$order];
        }

        foreach ($order as $order) {
            if (!is_array($order)) {
                continue;
            }

            $orderObj = new Order($order['OrderNumber']);

            if ($order['ArchiveParcelList'] === 'true') {
                $orderObj->setArchiveParcelList(true);
            }

            $billingAddress = $this->getAddress($order['BillingAddress']);
            $orderObj->setBillingAddress($billingAddress);

            if (!SoapTools::isSoapValueNull($order['Corporation'])) {
                $corporation = $this->getCorporation($order['Corporation']);
                $orderObj->setCorporation($corporation);
            }

            $orderObj->setCreationDate($order['CreationDate']);

            $customer = $this->getCustomer($order['Customer']);
            $orderObj->setCustomer($customer);

            if ($order['HasClaims'] === 'true') {
                $orderObj->setHasClaims(true);
            }

            $orderObj->setInitialTotalAmount(floatval($order['InitialTotalAmount']));
            $orderObj->setInitialTotalShippingChargesAmount(
                floatval($order['InitialTotalShippingChargesAmount'])
            );

            if ($order['IsCLogistiqueOrder'] === 'true') {
                $orderObj->setIsCLogistiqueOrder(true);
            }

            $orderObj->setLastUpdatedDate($order['LastUpdatedDate']);
            $orderObj->setModifiedDate($order['ModifiedDate']);

            if (!SoapTools::isSoapValueNull($order['OrderLineList'])) {
                $orderLineList = $this->getOrderLineList($order['OrderLineList']);
                $orderObj->setOrderLineList($orderLineList);
            }

            $orderObj->setOrderState($order['OrderState']);

            if (isset($order['PartnerOrderRef']) && !SoapTools::isSoapValueNull($order['PartnerOrderRef'])) {
                $orderObj->setPartnerOrderRef($order['PartnerOrderRef']);
            }

            if (isset($order['ModGesLog']) && !SoapTools::isSoapValueNull($order['ModGesLog'])) {
                $orderObj->setModGesLog($order['ModGesLog']);
            }

            $parcelList = $this->getParcelList($order['ParcelList']);
            $orderObj->setParcelList($parcelList);

            if (isset($order['VoucherList']) && !SoapTools::isSoapValueNull($order['VoucherList'])) {
                $voucherList = $this->getVoucherList($order['VoucherList']);
                $orderObj->setVoucherList($voucherList);
            }

            $orderObj->setShippedTotalAmount(floatval($order['ShippedTotalAmount']));

            $orderObj->setShippedTotalShippingCharges(floatval($order['ShippedTotalShippingCharges']));

            $billingAddress = $this->getAddress($order['ShippingAddress']);
            $orderObj->setShippingAddress($billingAddress);
            $orderObj->setShippingCode($order['ShippingCode']);
            $orderObj->setSiteCommissionPromisedAmount(floatval($order['SiteCommissionPromisedAmount']));
            $orderObj->setSiteCommissionShippedAmount(floatval($order['SiteCommissionShippedAmount']));
            $orderObj->setSiteCommissionValidatedAmount(floatval($order['SiteCommissionValidatedAmount']));

            $orderObj->setStatus($order['Status']);

            $orderObj->setValidatedTotalAmount(floatval($order['ValidatedTotalAmount']));
            $orderObj->setValidatedTotalShippingCharges(floatval($order['ValidatedTotalShippingCharges']));

            $orderObj->setValidationStatus($order['ValidationStatus']);

            $orderObj->setVisaCegid(intval($order['VisaCegid']));

            $this->orderList->addOrder($orderObj);
        }
    }

    /**
     * Retrieve <BillingAddress> Balise
     *
     * @param array $addressData
     * @return Address
     */
    private function getAddress($addressData)
    {
        $address = new Address();

        $address->setAddress1($addressData['Address1']);
        $address->setAddress2($addressData['Address2']);
        $address->setApartmentNumber($addressData['ApartmentNumber']);
        $address->setBuilding($addressData['Building']);
        $address->setCity($addressData['City']);
        $address->setCivility($addressData['Civility']);
        $address->setCompanyName($addressData['CompanyName']);
        $address->setCountry($addressData['Country']);
        $address->setCounty($addressData['County']);
        $address->setFirstName($addressData['FirstName']);
        $address->setInstructions($addressData['Instructions']);
        $address->setLastName($addressData['LastName']);
        $address->setPlaceName($addressData['PlaceName']);
        $address->setRelayId($addressData['RelayId']);
        $address->setStreet($addressData['Street']);
        $address->setZipCode($addressData['ZipCode']);

        return $address;
    }

    /**
     * Retrieve <Corporation> Balise
     *
     * @param $objCorporation
     * @return Corporation
     */
    private function getCorporation($objCorporation)
    {
        $corporation = new Corporation();

        $corporation->setBusinessUnitId(intval($objCorporation['BusinessUnitId']));
        $corporation->setCorporationCode($objCorporation['CorporationCode']);
        $corporation->setCorporationId(intval($objCorporation['CorporationId']));
        $corporation->setCorporationName($objCorporation['CorporationName']);

        if ($objCorporation['IsMarketPlaceActive'] === 'true') {
            $corporation->setIsMarketPlaceActive(true);
        }

        return $corporation;
    }

    /**
     * Retrieve <Corporation> Customer
     *
     * @param $objCustomer
     * @return Customer
     */
    private function getCustomer($objCustomer)
    {
        $customer = new Customer($objCustomer['CustomerId']);
        $customer->setCivility($objCustomer['Civility']);
        $customer->setEmail($objCustomer['Email']);
        $customer->setEncryptedEmail($objCustomer['EncryptedEmail']);
        $customer->setFirstName($objCustomer['FirstName']);
        $customer->setLastName($objCustomer['LastName']);
        $customer->setMobilePhone($objCustomer['MobilePhone']);
        $customer->setPhone($objCustomer['Phone']);
        $customer->setShippingFirstName($objCustomer['ShippingFirstName']);
        $customer->setShippingLastName($objCustomer['ShippingLastName']);
        $customer->setSecondPhone($objCustomer['Phone']);

        return $customer;
    }

    /**
     * @param $orderLineListOBJGlobal
     * @return OrderLineList
     */
    private function getOrderLineList($orderLineListOBJGlobal)
    {
        $orderLines = $orderLineListOBJGlobal['OrderLine'];
        if (isset($orderLines['ProductId'])) {
            $orderLines = array($orderLines);
        }

        $orderLineList = new OrderLineList();

        foreach ($orderLines as $orderLineListOBJ) {
            $orderLine = new OrderLine($orderLineListOBJ['ProductId']);

            $orderLine->setAcceptationState($orderLineListOBJ['AcceptationState']);
            $orderLine->setCategoryCode($orderLineListOBJ['CategoryCode']);

            $orderLine->setDeliveryDateMax($orderLineListOBJ['DeliveryDateMax']);
            $orderLine->setDeliveryDateMin($orderLineListOBJ['DeliveryDateMin']);

            if ($orderLineListOBJ['HasClaim'] === 'true') {
                $orderLine->setHasClaim(true);
            }
            $orderLine->setInitialPrice($orderLineListOBJ['InitialPrice']);
            if ($orderLineListOBJ['IsCDAV'] === 'true') {
                $orderLine->setCdav(true);
            }
            if ($orderLineListOBJ['IsNegotiated'] === 'true') {
                $orderLine->setIsNegotiated(true);
            }
            if ($orderLineListOBJ['IsProductEanGenerated'] === 'true') {
                $orderLine->setProductEanGenerated(true);
            }
            $orderLine->setName($orderLineListOBJ['Name']);

            $orderLine->setProductCondition($orderLineListOBJ['ProductCondition']);
            if (isset($orderLineListOBJ['ProductEan'])
                && !SoapTools::isSoapValueNull($orderLineListOBJ['ProductEan'])
            ) {
                $orderLine->setProductEan($orderLineListOBJ['ProductEan']);
            }
            $orderLine->setPurchasePrice(floatval($orderLineListOBJ['PurchasePrice']));
            $orderLine->setQuantity(intval($orderLineListOBJ['Quantity']));
            $orderLine->setRowId(intval($orderLineListOBJ['RowId']));
            $orderLine->setSellerProductId($orderLineListOBJ['SellerProductId']);
            $orderLine->setShippingDateMax($orderLineListOBJ['ShippingDateMax']);
            $orderLine->setShippingDateMin($orderLineListOBJ['ShippingDateMin']);
            $orderLine->setSku($orderLineListOBJ['Sku']);
            $orderLine->setSkuParent($orderLineListOBJ['SkuParent']);
            $orderLine->setUnitAdditionalShippingCharges(floatval($orderLineListOBJ['UnitAdditionalShippingCharges']));
            $orderLine->setUnitShippingCharges(floatval($orderLineListOBJ['UnitShippingCharges']));

            if (isset($orderLineListOBJ['RefundShippingCharges']) && $orderLineListOBJ['RefundShippingCharges'] === 'true') {
                $orderLine->setRefundShippingCharges(true);
            }
            $orderLineList->addOrderLine($orderLine);
        }

        return $orderLineList;
    }

    private function getParcelList($parcelList)
    {
        $parcelListObj = new ParcelList();

        $list = isset($parcelList['Parcel']) ? $parcelList['Parcel'] : [];

        if (empty($list)) {
            return $parcelListObj;
        }

        /**
         * Two formats are returned by the API:
         *
         * ```php
         * array:1 [
         *   "Parcel" => array:7 [
         *     "CustomerNum" => "3956091430101",
         *     ...
         *   ]
         * ]
         * ```
         * and
         *
         * ```php
         * array:1 [
         *   "Parcel" => array:2 [
         *     0 => array:7 [
         *       "CustomerNum" => "3953734760101",
         *       ...
         *     ]
         *     1 => array:7 [
         *       "CustomerNum" => "PT205400096JB";
         *       ...
         *     ]
         *   ]
         * ]
         * ```
         *
         * We need to deal with theses inconsistencies.
         * Thus, we check if the parcels list contains a "0" key.
         * If it does not, then we are in the 1st format ; we just
         * turn it into an array to handle it the same way the 2nd format is handled.
         */
        if (!array_key_exists(0, $list)) {
            $list = [$list];
        }

        foreach ($list as $parcel) {
            $parcelObj = new Parcel();
            $parcelObj->setCustomerNum($parcel['CustomerNum']);
            $parcelObj->setExternalCarrierName($parcel['ExternalCarrierName']);
            $parcelObj->setExternalCarrierTrackingUrl($parcel['ExternalCarrierTrackingUrl']);
            if ($parcel['IsCustomerReturn'] === 'true') {
                $parcelObj->setCustomerReturn(true);
            }
            $parcelObj->setParcelStatus($parcel['ParcelStatus']);
            $parcelObj->setRealCarrierCode($parcel['RealCarrierCode']);

            foreach ($parcel['ParcelItemList'] as $parcelItem) {
                $parcelItemObj = new ParcelItem($parcelItem['Sku']);
                $parcelItemObj->setQuantity(intval($parcelItem['Quantity']));
                $parcelItemObj->setProductName($parcelItem['ProductName']);

                $parcelObj->getParcelItemList()->addParcelItem($parcelItemObj);
            }

            $trackingList = new TrackingList();

            if (isset($parcel['TrackingList']) && !SoapTools::isSoapValueNull($parcel['TrackingList'])) {
                foreach ($parcel['TrackingList'] as $tracking) {
                    $trackingObj = new Tracking($tracking['TrackingId']);

                    if (isset($tracking['ParcelNum']) && !SoapTools::isSoapValueNull($tracking['ParcelNum'])) {
                        $trackingObj->setParcelNum($tracking['ParcelNum']);
                    }

                    if (isset($tracking['Justification']) && !SoapTools::isSoapValueNull($tracking['Justification'])) {
                        $trackingObj->setJustification($tracking['Justification']);
                    }

                    if (isset($tracking['InsertDate']) && !SoapTools::isSoapValueNull($tracking['InsertDate'])) {
                        $trackingObj->setInsertDate($tracking['InsertDate']);
                    }

                    $trackingList->addTrackingToLit($trackingObj);
                }

                $parcelObj->setTrackingList($trackingList);
            }

            $parcelListObj->addParcel($parcelObj);
        }

        return $parcelListObj;
    }

    /**
     * @param $voucherList
     * @return VoucherList
     */
    private function getVoucherList($voucherList)
    {
        $voucherListObj = new VoucherList();

        foreach ($voucherList as $voucher) {
            $voucherObj = new Voucher();

            if (isset($voucher['CreateDate']) && !SoapTools::isSoapValueNull($voucher['CreateDate'])) {
                $voucherObj->setCreateDate($voucher['CreateDate']);
            }

            if (isset($voucher['Source']) && !SoapTools::isSoapValueNull($voucher['Source'])) {
                $voucherObj->setSource($voucher['Source']);
            }

            $refundInfomation = new RefundInformation();
            if (isset($voucher['RefundInformation']) && !SoapTools::isSoapValueNull($voucher['RefundInformation'])) {
                if (isset($voucher['RefundInformation']['Amount'])
                    && !SoapTools::isSoapValueNull($voucher['RefundInformation']['Amount'])
                ) {
                    $refundInfomation->setAmount($voucher['RefundInformation']['Amount']);
                }

                if (isset($voucher['RefundInformation']['MotiveId'])
                    && !SoapTools::isSoapValueNull($voucher['RefundInformation']['MotiveId'])
                ) {
                    $refundInfomation->setMotiveId($voucher['RefundInformation']['MotiveId']);
                }
            }

            $voucherObj->setRefundInformation($refundInfomation);

            $voucherListObj->addVoucherToList($voucherObj);
        }

        return $voucherListObj;
    }
}
