<?php

declare(strict_types=1);

namespace Macademy\Minerva\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class NewAction extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Macademy_Minerva::faq_save';

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct
    (
        Context             $context,
        private PageFactory $pageFactory
    )
    {
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $page = $this->pageFactory->create();
        $page->setActiveMenu('Macademy_Minerva::faq');
        $page->getConfig()->getTitle()->prepend(__('New FAQs'));

        return $page;
    }
}
