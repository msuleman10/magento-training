<?php

namespace Pointeger\Core\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Customer\Model\SessionFactory;
use Magento\Store\Model\StoreManagerInterface;

class AfterOrderPlaceSandEmail implements ObserverInterface
{
    /**
     * @param TransportBuilder $transportBuilder
     * @param StoreManagerInterface $storeManager
     * @param SessionFactory $sessionFactory
     */
    public function __construct(
        private TransportBuilder      $transportBuilder,
        private StoreManagerInterface $storeManager,
        private SessionFactory        $sessionFactory
    )
    {
    }

    /**
     * @param Observer $observer
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\MailException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        if ($order->getPayment()->getMethod() === 'cashondelivery') {
            $templateVars = [
                'customer_name' => $this->getCustomerName(),
                'items' => $this->getOrderItems($order),
                'order_total' => $order->getGrandTotal(),
            ];

            $senderInfo = [
                'name' => 'Suleman',
                'email' => 'iam.suleman.m@gmail.com',
            ];

            $receiverEmail = $order->getCustomerEmail();
            $receiverName = $this->getCustomerName();

            $this->sendEmail(
                $templateVars,
                $senderInfo,
                $receiverEmail,
                $receiverName
            );
        }
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCustomerName()
    {
        $customerSession = $this->sessionFactory->create();
        if ($customerSession->isLoggedIn()) {
            $customerName = $customerSession->getCustomer()->getName();;
        } else {
            $customerName = "Guest";
        }
        return $customerName;
    }

    /**
     * @param $order
     * @return array
     */
    protected function getOrderItems($order)
    {
        $newData = [];
        foreach ($order->getAllVisibleItems() as $key => $item) {
            $newData[$key]['name'] = $item->getName();
            $newData[$key]['qty'] = $item->getQtyOrdered();
            $newData[$key]['price'] = $item->getPrice();
        }
        return $newData;
    }

    /**
     * @param $templateVars
     * @param $senderInfo
     * @param $receiverEmail
     * @param $receiverName
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\MailException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function sendEmail($templateVars, $senderInfo, $receiverEmail, $receiverName)
    {
        $storeId = $this->storeManager->getStore()->getId();

        $transport = $this->transportBuilder
            ->setTemplateIdentifier('custom_email_after_order_place')
            ->setTemplateOptions(['area' => 'frontend', 'store' => $storeId])
            ->setTemplateVars($templateVars)
            ->setFrom($senderInfo)
            ->addTo($receiverEmail, $receiverName)
            ->getTransport();

        $transport->sendMessage();
    }
}
