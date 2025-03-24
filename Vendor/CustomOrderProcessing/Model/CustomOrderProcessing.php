<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\CustomOrderProcessing\Model;

use Magento\Framework\Model\AbstractModel;
use Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface;

class CustomOrderProcessing extends AbstractModel implements CustomOrderProcessingInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Vendor\CustomOrderProcessing\Model\ResourceModel\CustomOrderProcessing::class);
    }

    /**
     * @inheritDoc
     */
    public function getCustomorderprocessingId()
    {
        return $this->getData(self::CUSTOMORDERPROCESSING_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCustomorderprocessingId($customorderprocessingId)
    {
        return $this->setData(self::CUSTOMORDERPROCESSING_ID, $customorderprocessingId);
    }

    /**
     * @inheritDoc
     */
    public function getOrderid()
    {
        return $this->getData(self::ORDERID);
    }

    /**
     * @inheritDoc
     */
    public function setOrderid($orderid)
    {
        return $this->setData(self::ORDERID, $orderid);
    }

    /**
     * @inheritDoc
     */
    public function getOldstatus()
    {
        return $this->getData(self::OLDSTATUS);
    }

    /**
     * @inheritDoc
     */
    public function setOldstatus($oldstatus)
    {
        return $this->setData(self::OLDSTATUS, $oldstatus);
    }

    /**
     * @inheritDoc
     */
    public function getNewstatus()
    {
        return $this->getData(self::NEWSTATUS);
    }

    /**
     * @inheritDoc
     */
    public function setNewstatus($newstatus)
    {
        return $this->setData(self::NEWSTATUS, $newstatus);
    }

    /**
     * @inheritDoc
     */
    public function getTimestamp()
    {
        return $this->getData(self::TIMESTAMP);
    }

    /**
     * @inheritDoc
     */
    public function setTimestamp($timestamp)
    {
        return $this->setData(self::TIMESTAMP, $timestamp);
    }
}
