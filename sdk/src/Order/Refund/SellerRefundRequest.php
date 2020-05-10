<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 15:11
 */

namespace Sdk\Order\Refund;


class SellerRefundRequest
{
    /**
     * @var string
     */
    private $_mode = null;

    /**
     * @var string
     */
    private $_motive = null;

    /**
     * @var RefundOrderLine
     */
    private $_refundOrderLine = null;

    /**
     * SellerRefundRequest constructor.
     * @param $refundOrderLine
     */
    public function __construct($refundOrderLine)
    {
        $this->_refundOrderLine = $refundOrderLine;
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->_mode;
    }

    /**
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->_mode = $mode;
    }

    /**
     * @return string
     */
    public function getMotive()
    {
        return $this->_motive;
    }

    /**
     * @param string $motive
     */
    public function setMotive($motive)
    {
        $this->_motive = $motive;
    }

    /**
     * @return RefundOrderLine
     */
    public function getRefundOrderLine()
    {
        return $this->_refundOrderLine;
    }

}
