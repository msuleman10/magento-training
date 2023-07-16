<?php declare(strict_types=1);

namespace Suleman\HelloWorld\Block;

use Suleman\HelloWorld\Model\ResourceModel\Car\Collection;
use Magento\Framework\View\Element\Template;

class Hello extends Template
{
    public function __construct
    (
        private Collection $collection,
        Template\Context $context,
        array $data = [])
    {
        parent::__construct($context, $data);
    }
    public function getAllCar(){
        return $this->collection;
    }
    public function getAddCarPostUrl(){
        return $this->getUrl("helloworld/car/add");
    }
}