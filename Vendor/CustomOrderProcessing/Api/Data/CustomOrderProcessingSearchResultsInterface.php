<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\CustomOrderProcessing\Api\Data;

interface CustomOrderProcessingSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get customOrderProcessing list.
     *
     * @return \Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface[]
     */
    public function getItems();

    /**
     * Set orderid list.
     *
     * @param \Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
