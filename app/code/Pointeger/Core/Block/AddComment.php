<?php

declare(strict_types=1);

namespace Pointeger\Core\Block;

use Magento\Framework\View\Element\Template;

class AddComment extends Template
{
    public function __construct
    (
        Template\Context $context,
        array            $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function getAddCommentUrl()
    {
        return $this->getUrl('core/comment/add');
    }
}
