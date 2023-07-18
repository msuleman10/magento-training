<?php
declare(strict_types=1);

namespace Pointeger\Core\Controller\Comment;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Form implements HttpGetActionInterface
{
    /**
     * @param PageFactory $pageFactory
     */
    public function __construct
    (
        private PageFactory $pageFactory
    )
    {
    }
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->pageFactory->create();
    }
}
