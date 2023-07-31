<?php

namespace Pointeger\Core\Model\Config\Source;

class Countries implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Pakistan')],
            ['value' => 1, 'label' => __('Afghanistan')],
            ['value' => 2, 'label' => __('Albanie')],
            ['value' => 3, 'label' => __('Algérie')],
            ['value' => 4, 'label' => __('Samoa Américaines')],
            ['value' => 5, 'label' => __('Andorre')]
        ];
    }
}
