<?php
declare(strict_types=1);

namespace Pointeger\Core\Controller\Comment;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Pointeger\Core\Model\CommentFactory;
use Magento\Framework\App\Action\Action;

class AjaxDelete extends Action
{
    /**
     * @param Context $context
     * @param CommentFactory $commentFactory
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context                $context,
        private CommentFactory $commentFactory,
        private JsonFactory $jsonFactory
    )
    {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $jsonData = $this->jsonFactory->create();
        try {
            $data = (array)$this->getRequest()->getParams();
            if ($data) {
                $model = $this->commentFactory->create()->load($data['id']);
                $model->delete();
                $this->messageManager->addSuccessMessage(__("Record Delete Successfully."));
            }
            return $jsonData->setData(["result" => true]);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t delete record, Please try again."));
            return $jsonData->setData(["result" => false]);
        }
    }
}
