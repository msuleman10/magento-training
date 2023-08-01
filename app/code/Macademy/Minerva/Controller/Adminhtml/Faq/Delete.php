<?php

declare(strict_types=1);

namespace Macademy\Minerva\Controller\Adminhtml\Faq;

use Macademy\Minerva\Model\ResourceModel\Faq as FaqResource;
use Macademy\Minerva\Model\FaqFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Macademy_Minerva::faq_delete';

    /**
     * @param FaqResource $faqResource
     * @param FaqFactory $faqFactory
     * @param Context $context
     */
    public function __construct
    (
        private FaqResource $faqResource,
        private FaqFactory  $faqFactory,
        Context             $context
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
            $faq = $this->faqFactory->create();
            $this->faqResource->load($faq, $id);
            if ($faq->getId()) {
                $this->faqResource->delete($faq);
                $this->messageManager->addSuccessMessage(__('Record deleted Successfully'));
            } else {
                $this->messageManager->addErrorMessage(__('Recored not deleted'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e);
        }
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $redirect->setPath("*/*");
    }
}
