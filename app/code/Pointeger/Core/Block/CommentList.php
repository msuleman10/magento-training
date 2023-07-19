<?php declare(strict_types=1);

namespace Pointeger\Core\Block;

use Magento\Framework\View\Element\Template;
use Pointeger\Core\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Customer\Model\SessionFactory;

class CommentList extends Template
{
    /**
     * @param CollectionFactory $collectionFactory
     * @param SessionFactory $sessionFactory
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct
    (
        private CollectionFactory $collectionFactory,
        private SessionFactory    $sessionFactory,
        Template\Context          $context,
        array                     $data = []
    )
    {
        parent::__construct($context, $data);
    }

    /**
     * @return \Pointeger\Core\Model\ResourceModel\Comment\Collection
     */
    public function getCustomerComment()
    {
        $commentCollection = $this->collectionFactory->create();
        $commentCollection->addFieldToFilter("customer_id", $this->getCustomerId());
        return $commentCollection;
    }

    /**
     * @return int|mixed
     */
    public function getCustomerId()
    {
        $customerSession = $this->sessionFactory->create();
        if ($customerSession->isLoggedIn()) {
            $customerId = $customerSession->getCustomer()->getId();
        } else {
            $customerId = 0;
        }
        return $customerId;
    }
}
