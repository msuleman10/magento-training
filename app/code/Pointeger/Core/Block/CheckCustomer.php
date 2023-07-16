<?php

declare(strict_types=1);

namespace Pointeger\Core\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\SessionFactory;

class CheckCustomer extends Template
{
    /**
     * @param SessionFactory $sessionFactory
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct
    (
        private SessionFactory $sessionFactory,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCustomerName()
    {
        $customerSession = $this->sessionFactory->create();
        if ($customerSession->isLoggedIn()) {
            $userName = $customerSession->getCustomer()->getName();
            $massege = "Welcome $userName, Thanks for login";
        } else {
            $massege = "This is Guest View, Nobody is loggedIn";
        }
        return $massege;
    }
}