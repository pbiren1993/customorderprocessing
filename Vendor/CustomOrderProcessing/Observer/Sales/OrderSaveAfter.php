<?php

namespace Vendor\CustomOrderProcessing\Observer\Sales;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Vendor\CustomOrderProcessing\Model\CustomOrderProcessingFactory;
use Magento\Sales\Model\Order\ShipmentFactory;
use Magento\Sales\Model\Order\ShipmentRepository;
use Magento\Sales\Model\Order\Email\Sender\ShipmentSender;
use Psr\Log\LoggerInterface;

class OrderSaveAfter implements ObserverInterface
{
    /**
     * @var orderRepository
     */
    protected $orderRepository;
    /**
     * @var customOrderProcessingFactory
     */
    protected $customOrderProcessingFactory;
    /**
     * @var shipmentFactory
     */
    protected $shipmentFactory;
    /**
     * @var shipmentRepository
     */
    protected $shipmentRepository;
    /**
     * @var shipmentSender
     */
    protected $shipmentSender;
    /**
     * @var logger
     */
    protected $logger;

    /**
     * [__construct description]
     * @param OrderRepositoryInterface     $orderRepository
     * @param CustomOrderProcessingFactory $customOrderProcessingFactory
     * @param ShipmentFactory              $shipmentFactory
     * @param ShipmentRepository           $shipmentRepository
     * @param ShipmentSender               $shipmentSender
     * @param LoggerInterface              $logger
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        CustomOrderProcessingFactory $customOrderProcessingFactory,
        ShipmentFactory $shipmentFactory,
        ShipmentRepository $shipmentRepository,
        ShipmentSender $shipmentSender,
        LoggerInterface $logger
    ) {
        $this->orderRepository = $orderRepository;
        $this->customOrderProcessingFactory = $customOrderProcessingFactory;
        $this->shipmentFactory = $shipmentFactory;
        $this->shipmentRepository = $shipmentRepository;
        $this->shipmentSender = $shipmentSender;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $oldStatus = $order->getOrigData('status'); // Get old status
        $newStatus = $order->getStatus(); // Get new status

        // Save to custom table
        $customOrderProcessing = $this->customOrderProcessingFactory->create();
        $customOrderProcessing->setOrderId($order->getId());
        $customOrderProcessing->setOldStatus($oldStatus);
        $customOrderProcessing->setNewStatus($newStatus);
        $customOrderProcessing->setTimestamp(date('Y-m-d H:i:s'));
        $customOrderProcessing->save();

        // Trigger shipment email if status is shipped
        if ($newStatus === 'shipped') {
            try {
                $shipments = $order->getShipmentsCollection();
                if ($shipments->getSize() > 0) {
                    foreach ($shipments as $shipment) {
                        if ($this->shipmentSender->send($shipment)) {
                            $this->logger->info('Shipment email sent successfully for Order ID: ' . $order->getId());
                        } else {
                            $this->logger->error('Failed to send shipment email for Order ID: ' . $order->getId());
                        }
                    }
                } else {
                    $this->logger->info('No shipment found for Order ID: ' . $order->getId());
                }
            } catch (\Exception $e) {
                $this->logger->error('Order ID: ' . $order->getId() . ' Error :' . $e->getMessage());
            }
        }
    }

    /**
     * @inheritdoc
     */
    private function createShipment($order)
    {
        // Prepare shipment items
        $items = [];
        foreach ($order->getAllItems() as $orderItem) {
            if ($orderItem->getQtyToShip() > 0 && !$orderItem->getIsVirtual()) {
                $items[$orderItem->getItemId()] = $orderItem->getQtyToShip();
            }
        }

        if (empty($items)) {
            return false; // No items to ship
        }

        // Create shipment
        $shipment = $this->shipmentFactory->create($order, $items);
        $shipment->register();
        $shipment->getOrder()->setIsInProcess(true);

        return $shipment;
    }
}
