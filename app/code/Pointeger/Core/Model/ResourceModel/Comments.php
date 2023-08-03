<?php

declare(strict_types=1);

namespace Pointeger\Core\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Comments extends AbstractDb
{
    const MAIN_TABLE = "customer_comments";
    const ID_FIELD_NAME = "entity_id";

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
