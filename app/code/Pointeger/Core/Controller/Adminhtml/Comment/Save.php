<?php

declare(strict_types=1);

namespace Pointeger\Core\Controller\Adminhtml\Comment;

use Exception;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Pointeger\Core\Model\CommentFactory;
use Pointeger\Core\Model\ResourceModel\Comment as CommentResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;

class Save extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = "Pointeger_Core::comment_save";

    /**
     * @param Context $context
     * @param CommentFactory $commentFactory
     * @param CommentResource $commentResource
     */
    public function __construct
    (
        Context                 $context,
        private CommentFactory  $commentFactory,
        private CommentResource $commentResource
    )
    {
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|(Redirect&ResultInterface)|ResultInterface
     */
    public function execute()
    {
        $post = $this->getRequest()->getPost();

        $comment = $this->commentFactory->create();
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if ($post->entity_id) {
            try {
                $this->commentResource->load($comment, $post->entity_id);
                if (!$comment->getData('entity_id')) {
                    throw new NotFoundException(__('This record is not longer exist.'));
                }
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $redirect->setPath("*/*/");
            }
        } else {
            $this->messageManager->addErrorMessage(__("There was a problem to saving the record"));
            return $redirect->setPath("*/*/");
        }
        $comment->setData(array_merge($comment->getData(), $post->toArray()));
        try {
            $this->commentResource->save($comment);
            $this->messageManager->addSuccessMessage(__("The record has been save"));
        } catch (Exception $e) {
            return $redirect->setPath("*/*/");
        }
        return $redirect->setPath("*/*/");
    }
}
