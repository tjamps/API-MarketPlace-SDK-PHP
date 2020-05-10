<?php
/**
 * Created by EQUIPE-SQLI
 * Date: 15/05/2017
 */
 
namespace Sdk\Fulfilment;

use Sdk\Common\CommonResult;

class FulfilmentActivationReportListResult extends CommonResult
{
    /*
     * @var array
     */
    private $_fulfilmentActivationReport = [];
    
     /*
     * @return array
     */
    public function getFulfilmentActivationReport()
    {
        return $this->_fulfilmentActivationReport;
    }
    
    /**
     * @param $fulfilmentActivationReport \Sdk\Fulfilment\FulfilmentActivationReport
     */
    public function addFulfilmentActivationReport($fulfilmentActivationReport)
    {
        $this->_fulfilmentActivationReport[] = $fulfilmentActivationReport;
    }
    
}
