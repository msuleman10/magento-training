<?php

declare(strict_types=1);

namespace Pointeger\Core\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Pointeger\Core\Api\Data\CommentInterface;

class Comment extends AbstractDb
{
    const TABLE_NAME = "customer_comments";
    protected $_idFieldName = CommentInterface::ENTITY_ID;
    protected $_mainTable = "customer_comments";

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init($this->_mainTable, CommentInterface::ENTITY_ID);
    }
}