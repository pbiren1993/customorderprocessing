<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\CustomOrderProcessing\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CustomOrderProcessingRepositoryInterface
{

    /**
     * Save customOrderProcessing
     *
     * @param \Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface $customOrderProcessing
     * @return \Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface $customOrderProcessing
    );

    /**
     * Retrieve customOrderProcessing
     *
     * @param string $customorderprocessingId
     * @return \Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($customorderprocessingId);

    /**
     * Retrieve customOrderProcessing matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete customOrderProcessing
     *
     * @param \Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface $customOrderProcessing
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface $customOrderProcessing
    );

    /**
     * Delete customOrderProcessing by ID
     *
     * @param string $customorderprocessingId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($customorderprocessingId);
}
