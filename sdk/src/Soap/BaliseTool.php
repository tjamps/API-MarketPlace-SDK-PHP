<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 17/10/2016
 * Time: 13:28
 */

namespace Sdk\Soap;

class BaliseTool
{
    /**
     * @var string
     */
    protected $_tag = null;

    /**
     * @var string
     */
    protected $_xmlns = '';

    /**
     * @var XmlUtils
     */
    protected $_xmlUtil;

    public function __construct()
    {
        $this->_xmlUtil = new XmlUtils('');
    }

    /**
     * @param $child
     * @return string
     */
    public function generateEnclosingBalise($child)
    {
        $xml = $this->_generateOpeningBalise();
        $xml .= $child;
        $xml .= $this->_generateClosingBalise();
        return $xml;
    }

    /**
     * @return string
     */
    protected function _generateOpenBalise()
    {
        return $this->_xmlUtil->generateOpenBalise($this->_tag);
    }

    /**
     * @return string
     */
    protected function _generateCloseBalise()
    {
        return $this->_xmlUtil->generateCloseBalise($this->_tag);
    }

    /**
     * @return string
     */
    private function _generateOpeningBalise()
    {
        $inlines = [$this->_xmlns];

        return $this->_xmlUtil->generateOpenBaliseWithInline($this->_tag, $inlines);
    }

    /**
     * @return string
     */
    private function _generateClosingBalise()
    {
        return $this->_xmlUtil->generateCloseBalise($this->_tag);
    }
}
