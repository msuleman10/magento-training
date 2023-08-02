<?php

declare(strict_types=1);

namespace Macademy\Minerva\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Macademy\Minerva\Model\FaqFactory;
use Macademy\Minerva\Model\ResourceModel\Faq as FaqResource;

class InlineEdit extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Macademy_Minerva::faq_save';

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param FaqFactory $faqFactory
     * @param FaqResource $faqResource
     */
    public function __construct(
        Context             $context,
        private JsonFactory $jsonFactory,
        private FaqFactory  $faqFactory,
        private FaqResource $faqResource
    )
    {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $json = $this->jsonFactory->create();
        $messages = [];
        $error = false;
        $isAjax = $this->getRequest()->getParam('isAjax', false);
        $items = $this->getRequest()->getParam('items', []);

        if (!$isAjax || !count($items)) {
            $messages[] = __('Please correct the data sent.');
            $error = true;
        }

        if (!$error) {
            foreach ($items as $item) {
                $id = $item['id'];
                try {
                    $faq = $this->faqFactory->create();
                    $this->faqResource->load($faq, $id);
                    $faq->setData(array_merge($faq->getData(), $item));
                    $this->faqResource->save($faq);
                } catch (\Exception $e) {
                    $messages[] = __("Something went wrong while saving item $id");
                    $error = true;
                }
            }
        }

        return $json->setData([
            'messages' => $messages,
            'error' => $error,
        ]);
    }
}
