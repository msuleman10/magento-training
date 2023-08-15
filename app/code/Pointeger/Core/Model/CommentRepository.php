<?php

declare(strict_types=1);

namespace Pointeger\Core\Model;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Pointeger\Core\Api\CommentRepositoryInterface;
use Pointeger\Core\Api\Data\CommentInterface;
use Pointeger\Core\Model\ResourceModel\Comment as ResourceComment;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct
    (
        private CommentFactory  $commentFactory,
        private ResourceComment $resourceComment
    )
    {
    }

    /**
     * @param int $entity_id
     * @return CommentInterface
     * @throws NoSuchEntityException
     */
    public function getByEntityId(int $entity_id): CommentInterface
    {
        $comment = $this->commentFactory->create();
        $this->resourceComment->load($comment, $entity_id);
        if (!$comment->getEntityId()) {
            throw new NoSuchEntityException(__("comment '%1' is not load", $entity_id));
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
            $this->resourceComment->save($comment);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $comment;
    }

    /**
     * @param int $entity_id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws LocalizedException
     */
    public function deleteByEntityId(int $entity_id): bool
    {
        $comment = $this->getByEntityId($entity_id);
        try {
            $this->resourceComment->delete($comment);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }
}
