<?php

declare(strict_types=1);

namespace Pointeger\Core\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Comment extends AbstractDb
{
    const MAIN_TABLE = "customer_comment";
    const TABLE_ID = "entity_id";

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::TABLE_ID);
    }
}
