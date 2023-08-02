<?php

declare(strict_types=1);

namespace Macademy\Minerva\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Faq extends AbstractDb
{
    const MAIN_TABLE = "macademy_minerva_faq";
    const ID_FIELD_NAME = "id";

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
