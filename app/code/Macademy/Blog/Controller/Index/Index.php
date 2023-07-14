<?php declare(strict_types=1);

namespace Macademy\Blog\Controller\Index;

use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;

class Index implements HttpGetActionInterface
{
    private $forwardFactory;

    public function __construct(
        ForwardFactory $forwardFactory
    ) {
        $this->forwardFactory = $forwardFactory;
    }

    public function execute()
    {
        $forwardf = $this->forwardFactory->create();
        return $forwardf->setModule('blog')->setController('post')->forward('list');
    }
}