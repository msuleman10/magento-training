<?php declare(strict_types=1);

namespace Macademy\Blog\Block;

use Macademy\Blog\Model\ResourceModel\Post\Collection;
use Magento\Framework\View\Element\Template;

class PostData extends Template
{
    public function __construct
    (
        private Collection $collection,
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }
    public function getCollectionItems(){
        return $this->collection->getItems();
    }
}