<?php

declare(strict_types=1);

namespace Pointeger\Core\Controller\Comment;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Pointeger\Core\Model\Comment;
use Pointeger\Core\Model\ResourceModel\Comment as ResourceModel;
use Magento\Customer\Model\SessionFactory;

class Add extends Action
{
    /**
     * @param Context $context
     * @param ResourceModel $resourceModel
     * @param SessionFactory $sessionFactory
     * @param Comment $comment
     */
    public function __construct
    (
        Context                $context,
        private ResourceModel  $resourceModel,
        private SessionFactory $sessionFactory,
        private Comment        $comment
    )
    {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $customerData = $this->getCustomerData();
        $data = $this->getRequest()->getParams();
        $data['name'] = $customerData['customer_name'];
        $data['customer_id'] = $customerData['customer_id'];
        $commentModel = $this->comment;
        if ($data['comment']) {
            $commentModel->setData($data);
            try {
                $this->resourceModel->save($commentModel);
                $this->messageManager->addSuccessMessage(__("Pending for approval"));
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage(__("Error saving comment"));
            }
        } else {
            $this->messageManager->addErrorMessage(__("Error saving comment"));
        }
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('core/comment/form');
        return $redirect;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCustomerData()
    {
        $customerData = [];
        $customerSession = $this->sessionFactory->create();
        if ($customerSession->isLoggedIn()) {
            $customerData['customer_name'] = $customerSession->getCustomer()->getName();
            $customerData['customer_id'] = $customerSession->getCustomer()->getId();
        } else {
            $customerData['customer_name'] = "Guest";
            $customerData['customer_id'] = 0;
        }
        return $customerData;
    }
}
