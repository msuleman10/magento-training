<?php

declare(strict_types=1);

namespace Pointeger\CoreExtra\Model;

class Product extends \Magento\Catalog\Model\Product
{
    /**
     * @return string
     */
    public function getName()
    {
        return $this->_getData(self::NAME) . ' - New Name';
    }
}


