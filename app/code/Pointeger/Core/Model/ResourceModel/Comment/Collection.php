<?php

declare(strict_types=1);

namespace Pointeger\Core\Model\ResourceModel\Comment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Pointeger\Core\Model\ResourceModel\Comment as ResourceModel;
use Pointeger\Core\Model\Comment as PostModel;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PostModel::class, ResourceModel::class);
    }
}