<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\CustomOrderProcessing\Api;

interface OrderstatusManagementInterface
{

    /**
     * Change order status
     *
     * @param string $incrementId
     * @param string $status
     * @return string
     */
    public function changeStatus($incrementId, $status);
}
