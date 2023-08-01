<?php

declare(strict_types=1);

namespace Macademy\Minerva\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Macademy_Minerva::faq';

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
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $page = $this->pageFactory->create();
        $page->setActiveMenu('Macademy_Minerva::faq');
        $page->getConfig()->getTitle()->prepend(__('FAQs'));

        return $page;
    }
}
