<?php

declare(strict_types=1);

namespace Pointeger\Core\Controller\Adminhtml\Comment;

use Exception;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Pointeger\Core\Model\CommentFactory;
use Pointeger\Core\Model\ResourceModel\Comment as CommentResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;

class NewSave extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = "Pointeger_Core::comment_save";

    /**
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param CommentFactory $commentFactory
     * @param CommentResource $commentResource
     */
    public function __construct
    (
        Context                   $context,
        private CollectionFactory $collectionFactory,
        private CommentFactory    $commentFactory,
        private CommentResource   $commentResource
    )
    {
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|(Redirect&ResultInterface)|ResultInterface
     */
    public function execute()
    {

        $comment = $this->commentFactory->create();
        $customerCollection = $this->collectionFactory->create();
        $post = $this->getRequest()->getPost();

        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if ($post->customer_id) {
            $customerData = $customerCollection->addFieldToFilter('entity_id', ['eq' => $post->customer_id]);
            unset($post->entity_id);
            $customerName = $customerData->getFirstItem()->getFirstname() . " " . $customerData->getFirstItem()->getLastname();
            $postData = $post->set('name', $customerName);
        } else {
            $this->messageManager->addErrorMessage(__("There was a problem to saving the record"));
            return $redirect->setPath("*/*/");
        }
        $comment->setData(array_merge($comment->getData(), $postData->toArray()));
        try {
            $this->commentResource->save($comment);
            $this->messageManager->addSuccessMessage(__("The record has been save"));
        } catch (Exception $e) {
            return $redirect->setPath("*/*/");
        }
        return $redirect->setPath("*/*/");
    }
}
