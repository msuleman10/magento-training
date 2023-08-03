<?php

declare(strict_types=1);

namespace Pointeger\Core\Model\ResourceModel\Comments;

use Pointeger\Core\Model\Comments;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Comments::class, \Pointeger\Core\Model\ResourceModel\Comments::class);
    }
}
