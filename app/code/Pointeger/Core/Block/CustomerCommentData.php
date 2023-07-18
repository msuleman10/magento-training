<?php declare(strict_types=1);

namespace Pointeger\Core\Block;

use Magento\Framework\View\Element\Template;
use Pointeger\Core\Model\ResourceModel\Comment\Collection;

class CustomerCommentData extends Template
{
    public function __construct
    (
        private Collection $collection,
        Template\Context   $context,
        array              $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function getCollectionItems()
    {
        return $this->collection->getItems();
    }
}
