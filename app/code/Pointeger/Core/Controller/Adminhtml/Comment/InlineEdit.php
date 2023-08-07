<?php

declare(strict_types=1);

namespace Pointeger\Core\Controller\Adminhtml\Comment;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Pointeger\Core\Model\CommentFactory;
use Pointeger\Core\Model\ResourceModel\Comment as CommentResource;

class InlineEdit extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Pointeger_Core::comment_save';

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param CommentFactory $commentFactory
     * @param CommentResource $commentResource
     */
    public function __construct(
        Context                 $context,
        private JsonFactory     $jsonFactory,
        private CommentFactory  $commentFactory,
        private CommentResource $commentResource
    )
    {
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute()
    {
        $json = $this->jsonFactory->create();
        $messages = [];
        $error = false;
        $isAjax = $this->getRequest()->getParam('isAjax', false);
        $items = $this->getRequest()->getParam('items', []);

        if (!$isAjax || !count($items)) {
            $messages[] = __('Please correct the data sent.');
            $error = true;
        }

        if (!$error) {
            foreach ($items as $item) {
                $id = $item['entity_id'];
                try {
                    $Comment = $this->commentFactory->create();
                    $this->commentResource->load($Comment, $id);
                    $Comment->setData(array_merge($Comment->getData(), $item));
                    $this->commentResource->save($Comment);
                } catch (Exception $e) {
                    $messages[] = __("Something went wrong while saving item $id");
                    $error = true;
                }
            }
        }

        return $json->setData([
            'messages' => $messages,
            'error' => $error,
        ]);
    }
}
