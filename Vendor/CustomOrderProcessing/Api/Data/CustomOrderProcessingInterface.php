<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\CustomOrderProcessing\Api\Data;

interface CustomOrderProcessingInterface
{

    public const NEWSTATUS = 'newstatus';
    public const OLDSTATUS = 'oldstatus';
    public const ORDERID = 'orderid';
    public const TIMESTAMP = 'timestamp';
    public const CUSTOMORDERPROCESSING_ID = 'customorderprocessing_id';

    /**
     * Get customorderprocessing_id
     *
     * @return string|null
     */
    public function getCustomorderprocessingId();

    /**
     * Set customorderprocessing_id
     *
     * @param string $customorderprocessingId
     * @return \Vendor\CustomOrderProcessing\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface
     */
    public function setCustomorderprocessingId($customorderprocessingId);

    /**
     * Get orderid
     *
     * @return string|null
     */
    public function getOrderid();

    /**
     * Set orderid
     *
     * @param string $orderid
     * @return \Vendor\CustomOrderProcessing\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface
     */
    public function setOrderid($orderid);

    /**
     * Get oldstatus
     *
     * @return string|null
     */
    public function getOldstatus();

    /**
     * Set oldstatus
     *
     * @param string $oldstatus
     * @return \Vendor\CustomOrderProcessing\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface
     */
    public function setOldstatus($oldstatus);

    /**
     * Get newstatus
     *
     * @return string|null
     */
    public function getNewstatus();

    /**
     * Set newstatus
     *
     * @param string $newstatus
     * @return \Vendor\CustomOrderProcessing\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface
     */
    public function setNewstatus($newstatus);

    /**
     * Get timestamp
     *
     * @return string|null
     */
    public function getTimestamp();

    /**
     * Set timestamp
     *
     * @param string $timestamp
     * @return \Vendor\CustomOrderProcessing\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface
     */
    public function setTimestamp($timestamp);
}
