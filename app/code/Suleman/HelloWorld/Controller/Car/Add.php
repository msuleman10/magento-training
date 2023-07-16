<?php declare(strict_types=1);

namespace Suleman\HelloWorld\Controller\Car;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Suleman\HelloWorld\Model\Car;
use Suleman\HelloWorld\Model\ResourceModel\Car as CarResource;

class Add extends Action
{
    public function __construct
    (
         Context $context,
        private Car $car,
        private CarResource $carResource
    )
    {
        parent::__construct($context);
    }
    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        /* Get the post data */
        $data = $this->getRequest()->getParams();

        /* Set the data in the model */
        $carModel = $this->car;
        $carModel->setData($data);

        try {
            /* Use the resource model to save the model in the DB */
            $this->carResource->save($carModel);
            $this->messageManager->addSuccessMessage("Car saved successfully!");
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__("Error saving car"));
        }

        /* Redirect back to cars page */
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('helloworld');
        return $redirect;
    }
}