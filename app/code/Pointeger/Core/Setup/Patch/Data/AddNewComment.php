<?php

declare(strict_types=1);

namespace Pointeger\Core\Setup\Patch\Data;

use Exception;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Pointeger\Core\Model\CommentFactory;

class AddNewComment implements DataPatchInterface
{
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CommentFactory $commentFactory
     */
    public function __construct
    (
        private ModuleDataSetupInterface $moduleDataSetup,
        private CommentFactory           $commentFactory
    )
    {
    }

    /**
     * @return array|string[]
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @return array|string[]
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @return void
     * @throws Exception
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $comment = $this->commentFactory->create();
        $newComment = [
            [
                'customer_id' => 1,
                'name' => 'Suleman',
                'comment' => 'today is vary hot'
            ],
            [
                'customer_id' => 2,
                'name' => 'Mark',
                'comment' => 'No today is good'
            ]
        ];
        foreach ($newComment as $commentData) {
            $comment->setData($commentData)->save();
        }
        $this->moduleDataSetup->endSetup();
    }
}
