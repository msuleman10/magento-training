<?php

declare(strict_types=1);

namespace Macademy\Minerva\Controller\Adminhtml\Faq;

use Macademy\Minerva\Model\FaqFactory;
use Macademy\Minerva\Model\ResourceModel\Faq as FaqResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;

class Save extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = "Macademy_Minerva::faq_save";

    /**
     * @param Context $context
     * @param FaqFactory $faqFactory
     * @param FaqResource $faqResource
     */
    public function __construct
    (
        Context             $context,
        private FaqFactory  $faqFactory,
        private FaqResource $faqResource
    )
    {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|(\Magento\Framework\Controller\Result\Redirect&\Magento\Framework\Controller\ResultInterface)|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $post = $this->getRequest()->getPost();
        $faq = $this->faqFactory->create();
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if ($post->id) {
            try {
                $this->faqResource->load($faq, $post->id);
                if (!$faq->getData('id')) {
                    throw new NotFoundException(__('This record is not longer exist.'));
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $redirect->setPath("*/*/");
            }
        } else {
            unset($post->id);
        }
        $faq->setData(array_merge($faq->getData(), $post->toArray()));
        try {
            $this->faqResource->save($faq);
            $this->messageManager->addSuccessMessage(__("The record has been save"));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("There was a problem to saving the record"));
            return $redirect->setPath("*/*/");
        }
        return $redirect->setPath("*/*/");
    }
}
