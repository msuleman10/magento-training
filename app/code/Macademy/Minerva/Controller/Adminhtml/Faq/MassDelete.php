<?php

declare(strict_types=1);

namespace Macademy\Minerva\Controller\Adminhtml\Faq;

use Macademy\Minerva\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Macademy_Minerva::faq';

    public function __construct
    (
        Context                   $context,
        private CollectionFactory $collectionFactory,
        private Filter            $filter
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->collectionFactory->create();
        $items = $this->filter->getCollection($collection);
        $itemsSize = $items->getSize();

        foreach ($items as $item) {
            $item->delete();
        }
        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $itemsSize));
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $redirect->setPath("*/*");
    }
}
