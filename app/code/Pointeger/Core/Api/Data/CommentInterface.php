<?php

declare(strict_types=1);

namespace Pointeger\Core\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface CommentInterface extends ExtensibleDataInterface
{
    const ENTITY_ID = "entity_id";
    const CUSTOMER_ID = "customer_id";
    const NAME = "name";
    const COMMENT = "comment";

    /**
     * @return int|null
     */
    public function getEntityId();

    /**
     * @param int $entityId
     * @return CommentInterface
     */
    public function setEntityId($entityId);

    /**
     * @return int|null
     */
    public function getCustomerId();

    /**
     * @param int $customerId
     * @return CommentInterface
     */
    public function setCustomerId($customerId);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return CommentInterface
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getComment();

    /**
     * @param string $comment
     * @return CommentInterface
     */
    public function setComment($comment);
}