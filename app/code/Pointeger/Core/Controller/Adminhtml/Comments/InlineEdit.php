<?php

declare(strict_types=1);

namespace Pointeger\Core\Controller\Adminhtml\Comments;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Pointeger\Core\Model\CommentsFactory;
use Pointeger\Core\Model\ResourceModel\Comments as CommentsResource;

class InlineEdit extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Macademy_Minerva::faq_save';

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param CommentsFactory $commentsFactory
     * @param CommentsResource $commentsResource
     */
    public function __construct(
        Context                  $context,
        private JsonFactory      $jsonFactory,
        private CommentsFactory  $commentsFactory,
        private CommentsResource $commentsResource
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
                    $comments = $this->commentsFactory->create();
                    $this->commentsResource->load($comments, $id);
                    $comments->setData(array_merge($comments->getData(), $item));
                    $this->commentsResource->save($comments);
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
