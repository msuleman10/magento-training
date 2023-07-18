<?php

declare(strict_types=1);

namespace Pointeger\Core\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Pointeger\Core\Api\Data\CommentInterface;

interface CommentRepositoryInterface
{
    /**
     * @param int $entityId
     * @return CommentInterface
     * @throws LocalizedException
     */
    public function getById(int $entityId): CommentInterface;

    /**
     * @param CommentInterface $comment
     * @return CommentInterface
     * @throws LocalizedException
     */
    public function save(CommentInterface $comment): CommentInterface;

    /**
     * @param int $entityId
     * @return bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $entityId): bool;

}