<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 15/11/2016
 * Time: 15:58
 */

namespace Sdk\Product;


class ProductMatching extends Product
{
    /**
     * @var string
     */
    private $_comment = null;

    /**
     * @var string
     */
    private $_ean = null;

    /**
     * @var string
     */
    private $_size = null;

    /**
     * @var string
     */
    private $_color = null;

    /**
     * @var string
     */
    private $_matchingStatus = null;

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->_comment;
    }

    /**
     * @param $comment
     */
    public function setComment($comment)
    {
        $this->_comment = $comment;
    }

    /**
     * @return string
     */
    public function getEan()
    {
        return $this->_ean;
    }

    /**
     * @param string $ean
     */
    public function setEan($ean)
    {
        $this->_ean = $ean;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->_size;
    }

    /**
     * @param string $size
     */
    public function setSize($size)
    {
        $this->_size = $size;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->_color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->_color = $color;
    }

    /**
     * @return string
     */
    public function getMatchingStatus()
    {
        return $this->_matchingStatus;
    }

    /**
     * @param string $matchingStatus
     */
    public function setMatchingStatus($matchingStatus)
    {
        $this->_matchingStatus = $matchingStatus;
    }
}
