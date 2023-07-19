<?php
declare(strict_types=1);

namespace Pointeger\Core\Controller\Comment;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Pointeger\Core\Model\CommentFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

class Delete extends Action
{
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param CommentFactory $commentFactory
     */
    public function __construct(
        Context                $context,
        private PageFactory    $resultPageFactory,
        private CommentFactory $commentFactory
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getParams();
            if ($data) {
                $model = $this->commentFactory->create()->load($data['id']);
                $model->delete();
                $this->messageManager->addSuccessMessage(__("Record Delete Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t delete record, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;

    }
}
