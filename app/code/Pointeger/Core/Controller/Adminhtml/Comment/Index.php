<?php

declare(strict_types=1);

namespace Pointeger\Core\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Pointeger_Core::comment';

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
        $page->setActiveMenu("Pointeger_Core::comment");
        $page->getConfig()->getTitle()->prepend(__("Comment"));
        return $page;
    }
}
