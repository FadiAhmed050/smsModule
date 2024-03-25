<?php
namespace Fadi\SmsNotification\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;


class ShipmentSms implements ObserverInterface{
    protected $logger;

    public function __construct(LoggerInterface $logger ) {
        $this->logger = $logger;
    }
    public function execute(Observer $observer){
        
        $order = $observer->getEvent()->getOrder();
        $newStatus = $order->getStatus();
        $phoneNumber = $order->getBillingAddress()->getTelephone();

        if ($newStatus == 'processing') {
            $infoToLog = 'Order number:'. $order->getIncrementId() .'has been Shipped, Customer Phone: '. $phoneNumber;
        } elseif ($newStatus == 'complete') {
            $infoToLog = 'Order number:'. $order->getIncrementId() .'has been Delivered, Customer Phone: '. $phoneNumber;
        } else {
            return;
        }

        $this->logger->info($infoToLog);
        }

}

?>