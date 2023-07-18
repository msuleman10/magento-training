<?php declare(strict_types=1);

namespace Pointeger\Core\Setup\Patch\Data;

use Pointeger\Core\Api\CommentRepositoryInterface;
use Pointeger\Core\Model\CommentFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class CoreComment implements DataPatchInterface
{
    public function __construct(
        private ModuleDataSetupInterface $moduleDataSetup,
        private CommentFactory $postFactory,
        private CommentRepositoryInterface $postRepository
    ) {}

    public static function getDependencies():array
    {
        return [];
    }

    public function getAliases():array
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $comment = $this->commentFactory->create();
        $comment->setData([
            'customer_id' => 1,
            'name' => 'Hello',
            'comment' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry."
        ]);
        $this->postRepository->save($comment);

        $this->moduleDataSetup->endSetup();
    }
}