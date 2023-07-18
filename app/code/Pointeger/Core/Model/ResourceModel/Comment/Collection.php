<?php

declare(strict_types=1);

namespace Pointeger\Core\Model\ResourceModel\Comment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Pointeger\Core\Model\ResourceModel\Comment as ResourceModel;
use Pointeger\Core\Model\Comment as CommentModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(CommentModel::class, ResourceModel::class);
    }
}