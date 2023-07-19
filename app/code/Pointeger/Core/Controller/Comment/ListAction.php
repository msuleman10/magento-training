<?php
declare(strict_types=1);

namespace Pointeger\Core\Controller\Comment;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\SessionFactory;

class ListAction implements HttpGetActionInterface
{
    /**
     * @param PageFactory $pageFactory
     * @param SessionFactory $sessionFactory
     * @param RedirectFactory $redirectFactory
     */
    public function __construct
    (
        private PageFactory     $pageFactory,
        private SessionFactory  $sessionFactory,
        private RedirectFactory $redirectFactory
    )
    {
    }

    public function execute()
    {
        $customerSession = $this->sessionFactory->create();
        if ($customerSession->isLoggedIn()) {
            return $this->pageFactory->create();
        } else {
            $redirect = $this->redirectFactory->create();
            return $redirect->setPath("customer/account/login");
        }
    }
}
