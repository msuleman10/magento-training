<?php

namespace Macademy\Blog\Controller\Index;


use Macademy\Blog\Helper\Data;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Index extends Action
{

    public function __construct(
        Context      $context,
        private Data $data
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $email = 'm.suleman@pointeger.com';
        $rseverName = 'Muhammad Suleman';

        $emailTemplateId = 'suleman_send_email';

        $templateVars = [
            'name' => 'Muhammad Suleman',
            'age' => '19',
        ];

        $this->data->sendEmail($email, $rseverName, $emailTemplateId, $templateVars);
    }
}
