<?php

declare(strict_types=1);

namespace Pointeger\Core\Controller\Adminhtml\Comments;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Pointeger_Core::comments';

    public function __construct
    (
        Context             $context,
        private PageFactory $pageFactory
    )
    {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $page = $this->pageFactory->create();
        $page->setActiveMenu("Pointeger_Core::comments");
        $page->getConfig()->getTitle()->prepend(__("Comments"));
        return $page;
    }
}
