<?php declare(strict_types=1);

namespace Suleman\HelloWorld\Model\ResourceModel\Car;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Suleman\HelloWorld\Model\ResourceModel\Car as ResourceModel;
use Suleman\HelloWorld\Model\Car as Model;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class,ResourceModel::class );
    }
}