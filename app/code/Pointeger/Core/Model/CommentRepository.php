<?php

declare(strict_types=1);

namespace Pointeger\Core\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Pointeger\Core\Api\Data\CommentInterface;
use Pointeger\Core\Api\commentRepositoryInterface;
use Pointeger\Core\Model\ResourceModel\Comment as ResourceModel;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @param CommentFactory $commentFactory
     * @param ResourceModel $commentResourceModel
     */
    public function __construct
    (
        private CommentFactory $commentFactory,
        private ResourceModel $commentResourceModel
    ) {

    }

    /**
     * @param int $entityId
     * @return CommentInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $entityId): CommentInterface
    {
        $comment = $this->commentFactory->create();
        $this->commentResourceModel->load($comment, $entityId);
        if (!$comment->getId()) {
            throw new  NoSuchEntityException(__('The blog post with the "%1" ID doesn\'t exist.', $entityId));
        }
        return $comment;
    }

    /**
     * @param CommentInterface $comment
     * @return CommentInterface
     * @throws CouldNotSaveException
     */
    public function save(CommentInterface $comment): CommentInterface
    {
        try {
            $this->commentResourceModel->save($comment);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception));
        }
        return $comment;
    }

    /**
     * @param int $entityId
     * @return bool
     * @throws CouldNotSaveException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $entityId): bool
    {
        $comment = $this->getById($entityId);
        try {
            $this->commentResourceModel->delete($comment);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception));
        }
        return true;
    }

}