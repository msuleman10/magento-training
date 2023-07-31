<?php

declare(strict_types=1);

namespace Pointeger\Core\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

class GetConfigValue extends Template
{
    /**
     * @param Template\Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct
    (
        Template\Context             $context,
        private ScopeConfigInterface $scopeConfig,
        array                        $data = []
    )
    {
        parent::__construct($context, $data);
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getConfigValue($code)
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue($code, $storeScope);
    }
}
