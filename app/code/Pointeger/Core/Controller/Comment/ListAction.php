<?php

namespace Pointeger\Core\Controller\Comment;

use Magento\Customer\Model\Url;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Exception\SessionException;
use Magento\Framework\View\Result\Page;
use Magento\Sales\Controller\OrderInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\SessionFactory;

class ListAction extends Action implements OrderInterface, HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param SessionFactory $sessionFactory
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        private SessionFactory $sessionFactory,
        Context                $context,
        PageFactory            $resultPageFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws NotFoundException
     * @throws SessionException
     */
    public function dispatch(RequestInterface $request)
    {
        $sessionData = $this->sessionFactory->create();
        $loginUrl = $this->_objectManager->get(Url::class)->getLoginUrl();

        if (!$sessionData->authenticate($loginUrl)) {
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
        }
        return parent::dispatch($request);
    }
}
