<?php
/* 
 * Created by EQUIPE-SQLI
 * Date : 12/05/2017
 * Time : 15:45
 */
namespace Sdk\Fulfilment;

class FulfilmentActivationReportRequest
{
    /**
     * @var string
     */
    private $_BeginDate = null;
    
    /**
     * @var string
     */
    private $_EndDate = null;

     /**
     * @var array
     */
    private $_DepositList = null;   
    
    /*
     * FulfilmentActivationReportRequest constructor
     * @param $BeginDate Date
     * @param $EndDate Date
     * @param $DepositList array
     */
    public function __construct($BeginDate, $EndDate, $DepositList) 
    {
        $this->_BeginDate = $BeginDate;
        $this->_EndDate = $EndDate;
        $this->_DepositList = $DepositList;
    }
    
    /**
     * @return string
     */
    public function getBeginDate()
    {
        return $this->_BeginDate;
    }
    
    /**
     * @return string
     */
    public function getEndDate()
    {
        return $this->_EndDate;
    }
    
    /**
     * @return array
     */
    public function getDepositList()
    {
        return $this->_DepositList;
    }
}
