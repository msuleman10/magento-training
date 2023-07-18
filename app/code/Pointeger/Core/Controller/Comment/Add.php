<?php

declare(strict_types=1);

namespace Pointeger\Core\Controller\Comment;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Pointeger\Core\Model\Comment;
use Pointeger\Core\Model\ResourceModel\Comment as ResourceModel;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class Add extends Action
{
    /**
     * @param Context $context
     * @param ResourceModel $resourceModel
     * @param Comment $comment
     */
    public function __construct
    (
        Context               $context,
        private ResourceModel $resourceModel,
        private Comment       $comment
    )
    {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $customer_id= $this->getRequest()->getParam("customer_id");
        $name = $this->getRequest()->getParam("name");
        $comment = $this->getRequest()->getParam("comment");
        $data = $this->getRequest()->getParams();
        $commentModel = $this->comment;

        if ($customer_id && $name && $comment){
            $commentModel->setData($data);
            try {
                $this->resourceModel->save($commentModel);
                $this->messageManager->addSuccessMessage(__("Comment Added Successfully."));
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage(__("Error saving comment"));
            }
        }else{
            $this->messageManager->addErrorMessage(__("Error saving comment"));
        }
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('core/comment/form');
        return $redirect;
    }
}
