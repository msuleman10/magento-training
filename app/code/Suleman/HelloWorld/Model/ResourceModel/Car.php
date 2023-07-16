<?php declare(strict_types=1);

namespace Suleman\HelloWorld\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Car extends AbstractDb
{

    protected function _construct()
    {
        $this->_init("my_car" , "car_id");
    }
}