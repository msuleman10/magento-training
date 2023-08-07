<?php

declare(strict_types=1);

namespace Pointeger\Core\Controller\Comment;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Pointeger\Core\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Customer\Model\SessionFactory;

class CommentData implements HttpGetActionInterface
{
    /**
     * @param CollectionFactory $collectionFactory
     * @param SessionFactory $sessionFactory
     * @param JsonFactory $jsonFactory
     */
    public function __construct
    (
        private CollectionFactory $collectionFactory,
        private SessionFactory    $sessionFactory,
        private JsonFactory       $jsonFactory
    )
    {
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

    /**
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute()
    {
        $commentCollection = $this->collectionFactory->create();
        $jsonData = $this->jsonFactory->create();
        $commentData = [];
        $result = $commentCollection->
        addFieldToFilter("customer_id", ['eq' => $this->getCustomerId()])->
        addFieldToFilter("is_published", ['eq' => 1])->getItems();
        foreach ($result as $items) {
            $commentData[] = $items->getData();
        }

        return $jsonData->setData(["result" => json_encode($commentData)]);
    }
}
