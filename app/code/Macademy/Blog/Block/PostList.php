<?php

declare(strict_types=1);

namespace Macademy\Blog\Block;

use Magento\Framework\View\Element\Template;
use Macademy\Blog\Model\ResourceModel\Post\Collection;

class PostList extends \Magento\Framework\View\Element\Template{

    public function __construct(
        private Collection $collection,
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }


    public function getMyName()
    {
        return 'Majid';
    }

    public function getCount(): int
    {
        return $this->collection->getSize();
    }
}