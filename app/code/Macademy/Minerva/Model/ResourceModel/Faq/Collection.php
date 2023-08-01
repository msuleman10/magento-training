<?php

declare(strict_types=1);

namespace Macademy\Minerva\Model\ResourceModel\Faq;

use Macademy\Minerva\Model\Faq;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
       $this->_init(Faq::class,\Macademy\Minerva\Model\ResourceModel\Faq::class);
    }
}
