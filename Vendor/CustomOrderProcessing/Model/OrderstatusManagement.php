<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\CustomOrderProcessing\Model;

use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

class OrderstatusManagement implements \Vendor\CustomOrderProcessing\Api\OrderstatusManagementInterface
{

    /**
     * @var orderRepository
     */
    protected $orderRepository;
    /**
     * @var searchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;
    /**
     * @var logger
     */
    protected $logger;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param SearchCriteriaBuilder    $searchCriteriaBuilder
     * @param LoggerInterface          $logger
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        LoggerInterface $logger
    ) {
        $this->orderRepository = $orderRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function changeStatus($incrementId, $status)
    {
        try {
            // Get order by increment ID
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter('increment_id', $incrementId)
                ->create();

            $orderList = $this->orderRepository->getList($searchCriteria)->getItems();

            if (!$orderList) {
                throw new NoSuchEntityException(__('Order not found.'));
            }

            $order = reset($orderList); // Get first order from the list
            $order->setStatus($status);
            $order->setIsInProcess(true);

            $this->orderRepository->save($order);

            return "Order status updated successfully.";
        } catch (\Exception $e) {
            $this->logger->error("Error updating order: " . $e->getMessage());
            return "Error: " . $e->getMessage();
        }
        // try {
        //     $order = $this->orderRepository->get($orderId);
            
        //     if (!$order->getEntityId()) {
        //         throw new LocalizedException(__('Order not found.'));
        //     }

        //     $order->setStatus($status);
        //     $this->orderRepository->save($order);

        //     return "Order status updated successfully to '{$status}'";
        // } catch (\Exception $e) {
        //     return "Error: " . $e->getMessage();
        // }
    }
}
