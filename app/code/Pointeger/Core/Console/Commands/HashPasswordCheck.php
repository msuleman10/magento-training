<?php

namespace Pointeger\Core\Console\Commands;


use Exception;
use Magento\Framework\Encryption\EncryptorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\ResourceConnection;

class HashPasswordCheck extends Command
{
    /**
     * @param ResourceConnection $resourceConnection
     * @param EncryptorInterface $encryptor
     * @param string|null $name
     */
    public function __construct(
        private ResourceConnection   $resourceConnection,
        protected EncryptorInterface $encryptor,
        string                       $name = null
    )
    {
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('pointeger:check-password');
        $this->setDescription('Password');
        $this->setDefinition([
            new InputOption(
                'path', 'p',
                InputOption::VALUE_REQUIRED,
                __("Full path to the password")
            )
        ]);
        parent::configure();
    }

    /**
     * @param $path
     * @return bool
     */
    public function doesPassswordExist($path)
    {
        $connection = $this->resourceConnection->getConnection();
        $tableName = $connection->getTableName('core_config_data');
        $select = $connection->select()
            ->from($tableName)
            ->where('path = ?', $path);

        $result = $connection->fetchRow($select);

        return $result !== false;
    }

    /**
     * @param $path
     * @return string
     */
    public function getPasssword($path)
    {
        $connection = $this->resourceConnection->getConnection();
        $tableName = $connection->getTableName('core_config_data');
        $select = $connection->select()
            ->from($tableName, "value")
            ->where('path = ?', $path);

        $result = $connection->fetchOne($select);

        return $result;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $passwordPath = $input->getOption("path");
            if ($this->doesPassswordExist($passwordPath)) {
                $hashPassword = $this->getPasssword($passwordPath);
                $password = $this->encryptor->decrypt($hashPassword);
                if (!empty($hashPassword)) {
                    $output->writeln("<info>'$password'</info>");
                } else {
                    $output->writeln("<error>'$passwordPath' value is empty</error>");
                }
            } else {
                $output->writeln("<error>'$passwordPath' does not exist.</error>");
            }
            return Command::SUCCESS;
        } catch (Exception $e) {
            return Command::FAILURE;
        }
    }
}
