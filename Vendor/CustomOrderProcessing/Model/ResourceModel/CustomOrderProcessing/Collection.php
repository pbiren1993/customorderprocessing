<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\CustomOrderProcessing\Model\ResourceModel\CustomOrderProcessing;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'customorderprocessing_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Vendor\CustomOrderProcessing\Model\CustomOrderProcessing::class,
            \Vendor\CustomOrderProcessing\Model\ResourceModel\CustomOrderProcessing::class
        );
    }
}
