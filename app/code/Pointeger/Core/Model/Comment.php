<?php

declare(strict_types=1);

namespace Pointeger\Core\Model;

use Magento\Framework\Model\AbstractModel;
use Pointeger\Core\Api\Data\CommentInterface;
use Pointeger\Core\Model\ResourceModel\Comment as ResourceModel;

class Comment extends AbstractModel implements CommentInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'pointeger_comment_model';
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @param int $entityId
     * @return Comment
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * {@inheritDoc}
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * {@inheritDoc}
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * {@inheritDoc}
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * {@inheritDoc}
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }
}