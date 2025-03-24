<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\CustomOrderProcessing\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class OrderStatus implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * Apply data patch
     */
    public function apply()
    {
        $installer = $this->moduleDataSetup;
        $installer->startSetup();

        $connection = $this->moduleDataSetup->getConnection();
        $statusTable = $this->moduleDataSetup->getTable('sales_order_status');
        $stateTable = $this->moduleDataSetup->getTable('sales_order_status_state');

        // Check if 'shipped' status already exists
        $select = $connection->select()
            ->from($statusTable, 'status')
            ->where('status = ?', 'shipped');
        $statusExists = $connection->fetchOne($select);

        if (!$statusExists) {
            // Insert new status
            $connection->insert(
                $statusTable,
                ['status' => 'shipped', 'label' => 'Shipped']
            );

            // Insert status into status_state
            $connection->insert(
                $stateTable,
                ['status' => 'shipped', 'state' => 'processing', 'is_default' => 0, 'visible_on_front' => 1]
            );
        }

        $installer->endSetup();
    }

    /**
     * Get dependencies
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Get Aliases
     */
    public function getAliases()
    {
        return [];
    }
}
