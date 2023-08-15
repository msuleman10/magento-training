<?php

declare(strict_types=1);

namespace Pointeger\Core\Model\ResourceModel\Comment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Pointeger\Core\Model\ResourceModel\Comment;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Pointeger\Core\Model\Comment::class, Comment::class);
    }
}
