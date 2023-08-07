<?php

declare(strict_types=1);

namespace Pointeger\Core\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Pointeger\Core\Model\ResourceModel\Comment\CollectionFactory as CommentCollectionFactory;
use Pointeger\Core\Model\ResourceModel\Comment\Collection;

class Comment extends AbstractDataProvider
{
    /** @var Collection $collection */
    protected $collection;
    /**
     * @var array
     */
    private array $loadedData;

    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CommentCollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct
    (
        $name,
        $primaryFieldName,
        $requestFieldName,
        CommentCollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (!isset($this->loadedData)) {
            $this->loadedData = [];

            foreach ($this->collection->getItems() as $item) {
                $this->loadedData[$item->getData('entity_id')] = $item->getData();
            }
        }
        return $this->loadedData;
    }
}
