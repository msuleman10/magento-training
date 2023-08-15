<?php

declare(strict_types=1);

namespace Pointeger\Core\Api\Data;

interface CommentInterface
{
    const ENTITY_ID = "entity_id";
    const CUSTOMER_ID = "customer_id";
    const NAME = "name";
    const COMMENT = "comment";

    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @param int $entity_id
     * @return int
     */
    public function setEntityId($entity_id);

    /**
     * @return int
     */
    public function getCustomerId();

    /**
     * @param int $customer_id
     * @return int
     */
    public function setCustomerId($customer_id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return string
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getComment();

    /**
     * @param string $comment
     * @return string
     */
    public function setComment($comment);
}
