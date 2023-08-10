<?php

namespace Pointeger\Core\Console\Commands;


use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\ResourceConnection;

class SetupPatchCheckCommand extends Command
{
    /**
     * @param ResourceConnection $resourceConnection
     * @param string|null $name
     */
    public function __construct(
        private ResourceConnection $resourceConnection,
        string                     $name = null
    )
    {
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('pointeger:dev:check-patch');
        $this->setDescription('Check if a setup patch exists');
        $this->setDefinition([
            new InputOption(
                'path', 'p',
                InputOption::VALUE_REQUIRED,
                __("Full path to the setup patch")
            ),
            new InputOption(
                'delete', 'd',
                InputOption::VALUE_OPTIONAL,
                __("input is true or false")
            )
        ]);
        parent::configure();
    }

    /**
     * @param $patchName
     * @return bool
     */
    public function doesPatchExist($patchName)
    {
        $connection = $this->resourceConnection->getConnection();
        $tableName = $connection->getTableName('patch_list');
        $select = $connection->select()
            ->from($tableName)
            ->where('patch_name = ?', $patchName);

        $result = $connection->fetchRow($select);

        return $result !== false;
    }

    /**
     * @param $patchName
     * @return bool
     */
    public function deletePatchExist($patchName)
    {
        $connection = $this->resourceConnection->getConnection();
        $tableName = $connection->getTableName('patch_list');
        $delete = $connection->delete(
            $tableName, ['patch_name = ?' => $patchName]
        );

        return $delete !== false;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $patchPath = $input->getOption("path");
            $patchCondition = $input->getOption("delete");
            if ($this->doesPatchExist($patchPath)) {
                if ($patchCondition === "1") {
                    if ($this->deletePatchExist($patchPath)) {
                        $output->writeln("<info>'$patchPath' deleted successfully</info>");
                    } else {
                        $output->writeln("<error>Unable to delete patch '$patchPath'.</error>");
                    }
                } else {
                    $output->writeln("<info>'$patchPath' patch exists</info>");
                }
            } else {
                $output->writeln("<error>'$patchPath' patch does not exist.</error>");
            }
            return Command::SUCCESS;
        } catch (Exception $e) {
            return Command::FAILURE;
        }
    }
}
