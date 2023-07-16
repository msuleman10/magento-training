<?php declare(strict_types=1);

namespace Suleman\HelloWorld\Model;

use Magento\Framework\Model\AbstractModel;
use Suleman\HelloWorld\Model\ResourceModel\Car as ResourceModel;
class Car extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
