<?php

namespace Pointeger\Core\Model\Config\Source;

use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

class RegisteredName implements OptionSourceInterface
{
    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct
    (
        private CollectionFactory $collectionFactory
    )
    {
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $customerCollection = $this->collectionFactory->create();
        $items = $customerCollection->getItems();
        $user = [];
        $data = [];
        foreach ($items as $key => $item) {
            $user[$key]["name"] = ['value' => $item["entity_id"], 'label' => $item["firstname"] . ' ' . $item["lastname"]];
        }
        foreach ($user as $newItem) {
            $data[] = $newItem['name'];
        }
        return $data;
    }
}

