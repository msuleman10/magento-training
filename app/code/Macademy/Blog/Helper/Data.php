<?php

namespace Macademy\Blog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper
{

    public function __construct(
        Context                  $context,
        private TransportBuilder $transportBuilder,
        private StateInterface   $inlineTranslation,
        private StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
    }

    public function sendEmail($email, $rseverName, $templateId, $templateVars = [])
    {
        try {
            $this->inlineTranslation->suspend();
            $storeId = $this->storeManager->getStore()->getId();
            $templateOptions = [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $storeId,
            ];
            $templateVars['store'] = $this->storeManager->getStore();
            $from = ['email' => 'iam.suleman.m@gmail.com', 'name' => 'Suleman'];

            $transport = $this->transportBuilder
                ->setTemplateIdentifier($templateId)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars($templateVars)
                ->setFrom($from)
                ->addTo($email, $rseverName)
                ->getTransport();

            $transport->sendMessage();
            $this->inlineTranslation->resume();

            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
