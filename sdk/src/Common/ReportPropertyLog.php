<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 09/11/2016
 * Time: 09:53
 */

namespace Sdk\Common;


use Sdk\Soap\Common\SoapTools;

class ReportPropertyLog
{
    /**
     * @var int
     */
    private $_errorCode = 0;

    /**
     * @var string
     */
    private $_logMessage = null;

    /**
     * @var string
     */
    private $_name = null;

    /**
     * @var string
     */
    private $_propertyError = null;

    /**
     * ReportPropertyLog constructor.
     * @param $errorCode
     */
    public function __construct($errorCode)
    {
        $this->_errorCode = $errorCode;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->_errorCode;
    }

    /**
     * @return string
     */
    public function getLogMessage()
    {
        return $this->_logMessage;
    }

    /**
     * @param string $logMessage
     */
    public function setLogMessage($logMessage)
    {
        if (!SoapTools::isSoapValueNull($logMessage)) {
            $this->_logMessage = $logMessage;
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        if (!SoapTools::isSoapValueNull($name)) {
            $this->_name = $name;
        }
    }

    /**
     * @return string
     */
    public function getPropertyError()
    {
        return $this->_propertyError;
    }

    /**
     * @param string $propertyError
     */
    public function setPropertyError($propertyError)
    {
        if (!SoapTools::isSoapValueNull($propertyError)) {
            $this->_propertyError = $propertyError;
        }
    }
}
