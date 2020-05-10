<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 16/11/2016
 * Time: 15:20
 */

namespace Sdk\Soap\Product;


use Sdk\Soap\XmlUtils;

class GetAllAllowedCategoryTree
{
    private $_tag = 'GetAllAllowedCategoryTree';

    private $_xmlns = '';

    private $_xmlUtil;

    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_xmlUtil = new XmlUtils('');
    }

    public function generateEnclosingBalise($child)
    {
        $xml = $this->_generateOpeningBalise();
        $xml .= $child;
        $xml .= $this->_generateClosingBalise();
        return $xml;
    }

    private function _generateOpeningBalise()
    {
        $inlines = [$this->_xmlns];

        return $this->_xmlUtil->generateOpenBaliseWithInline($this->_tag, $inlines);
    }

    private function _generateClosingBalise()
    {
        return $this->_xmlUtil->generateCloseBalise($this->_tag);
    }
}
