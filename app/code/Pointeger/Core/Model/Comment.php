<?php

declare(strict_types=1);

namespace Pointeger\Core\Model;

use Magento\Framework\Model\AbstractModel;
use Pointeger\Core\Model\ResourceModel\Comment as ResourceModel;

class Comment extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}