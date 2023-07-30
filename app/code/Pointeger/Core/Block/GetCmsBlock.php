<?php

declare(strict_types=1);

namespace Pointeger\Core\Block;

use Magento\Framework\View\Element\Template;
use Magento\Checkout\Model\Session as CheckoutSession;

class GetCmsBlock extends Template
{
    /**
     * @param Template\Context $context
     * @param CheckoutSession $checkoutSession
     * @param array $data
     */
    public function __construct
    (
        Template\Context        $context,
        private CheckoutSession $checkoutSession,
        array                   $data = []
    )
    {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCmsBlock()
    {
        if ($this->getCartItemsQuantity() > 2) {
            $items = $this->getLayout()->createBlock('Magento\Cms\Block\Block')->setBlockId('men-block')->toHtml();
        } else {
            $items = "";
        }
        return $items;
    }

    /**
     * @return int|null
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCartItemsQuantity()
    {
        return count($this->checkoutSession->getQuote()->getAllVisibleItems());
    }
}
