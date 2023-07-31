<?php

namespace Pointeger\Core\Controller\Demo;

use Magento\Framework\App\Action\Context;
use Pointeger\Core\Helper\Data;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @param Context $context
     * @param Data $data
     */
    public function __construct
    (
        Context      $context,
        private Data $data
    )
    {
        parent::__construct($context);
    }

    /**
     * @return void
     */
    public function execute()
    {
        echo $this->data->getGeneralConfig('enable');
        echo $this->data->getGeneralConfig('text_test');
        echo $this->data->getGeneralConfig('textarea');
        exit();
    }
}
