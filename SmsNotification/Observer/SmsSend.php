<?php
namespace Fadi\SmsNotification\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;


class SmsSend implements ObserverInterface{

    protected $logger;

    public function __construct(LoggerInterface $logger){
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $phoneNumber = $order->getBillingAddress()->getTelephone();
        $infoToLog = 'Order number:'. $order->getIncrementId() .'has been placed, Customer Phone: '. $phoneNumber;
        $this->logger->info($infoToLog);
    }}

?>