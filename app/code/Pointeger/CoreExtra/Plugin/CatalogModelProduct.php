<?php

declare(strict_types=1);

namespace Pointeger\CoreExtra\Plugin;

use Magento\Catalog\Model\Product;

class CatalogModelProduct
{
    /**
     * @param Product $subject
     * @param $result
     * @return string
     */
    public function afterGetName
    (
        Product $subject,
                $result
    )
    {
        return $result . " - 50% discount";
    }
}
