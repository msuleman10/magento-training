<?php

declare(strict_types=1);

namespace Macademy\Minerva\Setup\Patch\Data;

use Macademy\Minerva\Model\ResourceModel\Faq;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class InitialFaqs implements DataPatchInterface
{
    public function __construct
    (
        private ModuleDataSetupInterface $moduleDataSetup,
        private ResourceConnection $connection
    ){}

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $conection=$this->connection->getConnection();
        $data=[
            [
                'question' => 'What is your best selling item?',
                'answer' => 'The item you buy!',
                'is_published' => 1,
            ],
            [
                'question' => 'What is your customer support number?',
                'answer' => '212-867-5309. Ask for Jenny!',
                'is_published' => 1,
            ],
            [
                'question' => 'When will I get my order?',
                'answer' => 'When it gets delivered, silly!',
                'is_published' => 0,
            ]
        ];
        $conection->insertMultiple(Faq::MAIN_TABLE , $data);
        return $this;
    }
}
