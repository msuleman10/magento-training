<?php

declare(strict_types=1);

namespace Macademy\Minerva\Controller\Adminhtml\Faq;

use Exception;
use Macademy\Minerva\Model\ResourceModel\Faq as FaqResource;
use Macademy\Minerva\Model\FaqFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

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
     * @return ResponseInterface|Redirect|(Redirect&ResultInterface)|ResultInterface
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
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e);
        }
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $redirect->setPath("*/*");
    }
}
