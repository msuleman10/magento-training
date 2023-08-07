<?php

declare(strict_types=1);

namespace Pointeger\Core\Controller\Adminhtml\Comment;

use Exception;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Pointeger\Core\Model\ResourceModel\Comment as CommentResource;
use Pointeger\Core\Model\CommentFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Macademy_Minerva::faq_delete';

    /**
     * @param CommentResource $commentResource
     * @param CommentFactory $commentFactory
     * @param Context $context
     */
    public function __construct
    (
        private CommentResource $commentResource,
        private CommentFactory  $commentFactory,
        Context                 $context
    )
    {
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|(Redirect&ResultInterface)|ResultInterface
     */
    public function execute()
    {
        try {
            $id = $this->getRequest()->getParam('entity_id');
            $faq = $this->commentFactory->create();
            $this->commentResource->load($faq, $id);
            if ($faq->getEntityId()) {
                $this->commentResource->delete($faq);
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
