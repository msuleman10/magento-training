<?php

declare(strict_types=1);

namespace Pointeger\Core\Model;

use Magento\Framework\Model\AbstractModel;
use Pointeger\Core\Api\Data\CommentInterface;

class Comment extends AbstractModel implements CommentInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Comment::class);
    }

    /**
     * @return array|int|mixed|null
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @param $customer_id
     * @return int|Comment
     */
    public function setCustomerId($customer_id)
    {
        return $this->setData(self::CUSTOMER_ID, $customer_id);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param $name
     * @return Comment|string
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * @param $comment
     * @return Comment|string
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }
}
