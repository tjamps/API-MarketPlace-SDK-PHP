<?php

/* 
 * Created by Cdiscount
 * Date : 31/01/2017
 * Time : 10:58
 */

namespace Sdk\Common;

abstract class CommonResult 
{
    /*
     * @var string
     */
    protected $_errorMessage;

    /**
     * @var bool
     */
    protected $_operationSuccess;

    /**
     * @var array
     */
    protected $_errorList;

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }
    
    /*
     * @param $errorMessage
     */
    public function  setErrorMessage($errorMessage)
    {
        $this->_errorMessage = $errorMessage;
    }

    /**
     * @return mixed
     */
    public function isOperationSuccess()
    {
        return $this->_operationSuccess;
    }
    
    /*
     * @param $operationSuccess
     */
    public function setOperationSuccess($operationSuccess)
    {
        $this->_operationSuccess = $operationSuccess;
    }

    /**
     * @return array
     */
    public function getErrorList()
    {
        return $this->_errorList;
    }
    
    /*
     * @param $errorMessage
     */
    public function addErrorToList($errorMessage)
    {
        $this->_errorList[] = $errorMessage;
    }
}
