<?php
declare(strict_types=1);

namespace Pointeger\Core\ViewModel;

use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CheckCustomer implements ArgumentInterface
{
    /**
     * @param SessionFactory $sessionFactory
     */
    public function __construct(
        private SessionFactory $sessionFactory
    ) {
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    public function getCustomerName()
    {
        $customerSession = $this->sessionFactory->create();
        if ($customerSession->isLoggedIn()) {
            $customerName = $customerSession->getCustomer()->getName();
            $massege = "Welcome $customerName, Thanks for login";
        } else {
            $massege = " This is Guest View, Nobody is loggedIn.";
        }
        return $massege;
    }
}