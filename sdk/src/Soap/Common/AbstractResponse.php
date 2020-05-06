<?php

namespace Sdk\Soap\Common;

use Sdk\ArrayHelpers\ArrayHelpers;
use Sdk\Exception\InvalidDataResponseException;
use Sdk\Exception\ResponseErrorException;

abstract class AbstractResponse
{
    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @var
     */
    protected $operationSuccess;

    /**
     * @var
     */
    protected $errorList = [];

    /**
     * @var
     */
    protected $sellerLogin;

    /**
     * @var
     */
    protected $tokenID;

    /**
     * @var bool
     */
    protected $hasError = false;

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        $message = $this->errorMessage;

        if (!empty($this->errorList)) {
            $message = sprintf('%s - %s', $message, implode(' - ', $this->errorList));
        }

        return $message;
    }


    public function getOperationSuccess()
    {
        return $this->operationSuccess;
    }


    public function getErrorList()
    {
        return $this->errorList;
    }


    public function getSellerLogin()
    {
        return $this->sellerLogin;
    }


    public function getTokenID()
    {
        return $this->tokenID;
    }

    /**
     * @return boolean
     */
    public function hasError()
    {
        return $this->hasError;
    }

    /**
     * Check error message and operation success flag
     * @param array $xml
     * @return bool
     */
    protected function isOperationSuccess($xml)
    {
        $objError = $xml['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {
            $this->hasError = true;
            $this->errorMessage = $objError['_'];
        }
        if (isset($xml['OperationSuccess']['_']) && $xml['OperationSuccess']['_'] === 'true') {
            return true;
        }

        return false;
    }

    /**
     * @param array $xml
     * @param string $key
     *
     * @return bool
     */
    protected function isXmlValueSet($xml, $key)
    {
        return isset($xml[$key]) && !SoapTools::isSoapValueNull($xml[$key]);
    }

    /**
     * @param $xml
     * @param $key
     * @throws InvalidDataResponseException
     */
    protected function checkResponseDataValidity($xml, $key)
    {
        if (!ArrayHelpers::has($xml, $key)) {
            throw new InvalidDataResponseException(sprintf('Expected "%s" key not found in XML response', $key));
        }
    }

    /**
     * @param array $xml
     * @throws ResponseErrorException
     */
    protected function checkErrors($xml, $ignoredErrors)
    {
        if (isset($xml['ErrorMessage']) && !SoapTools::isSoapValueNull(
                $xml['ErrorMessage']
            ) && !empty($xml['ErrorMessage']['_'])) {
            $this->errorMessage = $xml['ErrorMessage']['_'];
            $this->hasError = true;
        } elseif (isset($xml['a:ErrorMessage']) && !SoapTools::isSoapValueNull(
                $xml['a:ErrorMessage']
            ) && !empty($xml['a:ErrorMessage']['_'])) {
            $this->errorMessage = $xml['a:ErrorMessage']['_'];
            $this->hasError = true;
        }

        /**
         * Errors can be returned in the following two formats:
         * "ErrorList" => array:1 [
         *   "Error" => array:2 [
         *       0 => array:2 [
         *           "ErrorType" => "OrderLineError"
         *           "Message" => "Ligne rejetée car commande rejetée"
         *       ]
         *       1 => array:2 [
         *           "ErrorType" => "OrderLineError"
         *           "Message" => "La commande est non éligible au mode de livraison choisi. Contacter le support pour plus de détails"
         *       ]
         *   ]
         * ]
         *
         * and:
         *
         * "ErrorList" => array:1 [
         *     "Error" => array:2 [
         *        "ErrorType" => "OrderLineError"
         *        "Message" => "Email_KO"
         *    ]
         * ]
         *
         * Since we need to handle both formats, we "normalize" errors array by checking if the index "0"
         * exists in the array ; if not, then we are in the second format, which we turn into an array.
         */

        if (isset($xml['ErrorList']['Error']) && is_array($xml['ErrorList']['Error'])) {
            if (!array_key_exists(0, $xml['ErrorList']['Error'])) {
                $xml['ErrorList']['Error'] = [$xml['ErrorList']['Error']];
            }

            foreach ($xml['ErrorList']['Error'] as $error) {
                $this->errorList[] = isset($error['Message']) ? $error['Message'] : 'Unknown error';
            }
            $this->hasError = true;
        } elseif (isset($xml['a:ErrorList']['a:Error']) && is_array($xml['a:ErrorList']['a:Error'])) {
            if (!array_key_exists(0, $xml['a:ErrorList']['a:Error'])) {
                $xml['a:ErrorList']['a:Error'] = [$xml['a:ErrorList']['a:Error']];
            }

            foreach ($xml['a:ErrorList']['a:Error'] as $error) {
                $this->errorList[] = isset($error['a:Message']) ? $error['a:Message'] : 'Unknown error';
            }
            $this->hasError = true;
        }


        $allErrors = array_filter(array_merge([$this->errorMessage], $this->errorList));
        $diff = array_diff($allErrors, $ignoredErrors);
        if (empty($diff)) {
            return;
        }

        if ($this->hasError) {
            throw new ResponseErrorException($this->getErrorMessage());
        }
    }
}
