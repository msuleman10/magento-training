<?php

declare(strict_types=1);

namespace Pointeger\CoreExtra\Plugin;

use Magento\Framework\App\RequestInterface;

class NameValidation
{
    /**
     * @param RequestInterface $request
     */
    public function __construct
    (
        private RequestInterface $request
    )
    {
    }

    /**
     * @param \Magento\Customer\Controller\Account\CreatePost $subject
     * @return mixed
     */
    public function beforeExecute
    (
        \Magento\Customer\Controller\Account\CreatePost $subject
    )
    {
        $oldName = $this->request->getParam("firstname");
        if (strlen($oldName) > 6) {
            $newName = substr($oldName, 0, 6);
        } else {
            $newName = $oldName;
        }
        return $this->request->setParam("firstname", $newName);
    }
}
