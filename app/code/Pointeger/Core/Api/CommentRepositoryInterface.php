<?php

declare(strict_types=1);

namespace Pointeger\Core\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Pointeger\Core\Api\Data\CommentInterface;

interface CommentRepositoryInterface
{
    /**
     * @param int $entity_id
     * @return CommentInterface
     * @throws LocalizedException
     */
    public function getByEntityId(int $entity_id): CommentInterface;

    /**
     * @param CommentInterface $comment
     * @return CommentInterface
     * @throws LocalizedException
     */
    public function save(CommentInterface $comment): CommentInterface;

    /**
     * @param int $entity_id
     * @return bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function deleteByEntityId(int $entity_id): bool;
}
