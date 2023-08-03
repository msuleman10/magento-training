<?php

declare(strict_types=1);

namespace Pointeger\Core\Model;

use Magento\Framework\Model\AbstractModel;

class Comments extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Comments::class);
    }
}
