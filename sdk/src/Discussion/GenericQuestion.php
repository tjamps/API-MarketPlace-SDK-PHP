<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 04/11/2016
 * Time: 10:45
 */

namespace Sdk\Discussion;


use Sdk\Soap\Common\SoapTools;

class GenericQuestion
{
    /**
     * @var string
     */
    private $_closeDate = null;

    /**
     * @var string
     */
    private $_creationDate = null;

    /**
     * @var string
     */
    private $_lastUpdatedDate = null;

    /**
     * @var array
     */
    private $_messageList = null;

    /**
     * @var string
     */
    private $_status = null;

    /**
     * @var string
     */
    private $_subject = null;

    /**
     * @var int
     */
    private $_id = 0;

    /**
     * OrderClaim constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getCloseDate()
    {
        return $this->_closeDate;
    }

    /**
     * @param string $closeDate
     */
    public function setCloseDate($closeDate)
    {
        if (!SoapTools::isSoapValueNull($closeDate)) {
            $this->_closeDate = $closeDate;
        }
    }

    /**
     * @return string
     */
    public function getCreationDate()
    {
        return $this->_creationDate;
    }

    /**
     * @param string $creationDate
     */
    public function setCreationDate($creationDate)
    {
        if (!SoapTools::isSoapValueNull($creationDate)) {
            $this->_creationDate = $creationDate;
        }
    }

    /**
     * @return string
     */
    public function getLastUpdatedDate()
    {
        return $this->_lastUpdatedDate;
    }

    /**
     * @param string $lastUpdatedDate
     */
    public function setLastUpdatedDate($lastUpdatedDate)
    {
        if (!SoapTools::isSoapValueNull($lastUpdatedDate)) {
            $this->_lastUpdatedDate = $lastUpdatedDate;
        }
    }

    /**
     * @return array
     */
    public function getMessageList()
    {
        return $this->_messageList;
    }

    /**
     * @param $message \Sdk\Discussion\Message
     */
    public function addMessageToList($message)
    {
        if ($this->_messageList == null) {
            $this->_messageList = [];
        }
        if ($message != null) {
            $this->_messageList[] = $message;
        }
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        if (!SoapTools::isSoapValueNull($status)) {
            $this->_status = $status;
        }
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        if (!SoapTools::isSoapValueNull($subject)) {
            $this->_subject = $subject;
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }
}
