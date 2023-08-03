<?php

declare(strict_types=1);

namespace Pointeger\Core\Controller\Adminhtml\Comments;

use Exception;
use Pointeger\Core\Model\ResourceModel\Comments as CommentsResource;
use Pointeger\Core\Model\CommentsFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Macademy_Minerva::faq_delete';

    /**
     * @param CommentsResource $commentsResource
     * @param CommentsFactory $commentsFactory
     * @param Context $context
     */
    public function __construct
    (
        private CommentsResource $commentsResource,
        private CommentsFactory  $commentsFactory,
        Context                  $context
    )
    {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|(\Magento\Framework\Controller\Result\Redirect&\Magento\Framework\Controller\ResultInterface)|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $id = $this->getRequest()->getParam('id');
            $faq = $this->commentsFactory->create();
            $this->commentsResource->load($faq, $id);
            if ($faq->getId()) {
                $this->commentsResource->delete($faq);
                $this->messageManager->addSuccessMessage(__('Record deleted Successfully'));
            } else {
                $this->messageManager->addErrorMessage(__('Recored not deleted'));
            }
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e);
        }
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $redirect->setPath("*/*");
    }
}
