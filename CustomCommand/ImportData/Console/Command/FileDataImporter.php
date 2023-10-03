<?php

namespace CustomCommand\ImportData\Console\Command;

use CustomCommand\ImportData\Api\ProfileInterface;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class FileDataImporter
 * @package CustomCommand\ImportData\Console\Command
 */
class FileDataImporter extends Command
{
    
    private const PROFILE = 'profile';

    /**
     * The profiles property holds an array of profile objects.
     *
     * @var ProfileInterface[]
     */
    protected $profiles;

    /**
     * FileDataImporter constructor.
     *
     * @param ProfileInterface $csvProfile
     * @param ProfileInterface $jsonProfile
     */
    public function __construct(ProfileInterface $csvProfile, ProfileInterface $jsonProfile)
    {
        $this->profiles = [
            'csv' => $csvProfile,
            'json' => $jsonProfile,
        ];
        parent::__construct();
    }

    /**
     * Configure the command
     */
    protected function configure()
    {
        $options = [
            new InputOption(
                self::PROFILE,
                '-s',
                InputOption::VALUE_REQUIRED,
                'Specify the file extension'
            ),
        ];
        $this->setName('customer:importer')
            ->setDescription('Import customer data')
            ->setDefinition($options)
            ->addArgument('sourcePath', InputArgument::REQUIRED, 'Provide source path');
        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $source = (string)$input->getArgument('sourcePath');
        $profile = $input->getOption('profile');
        try {
            switch ($profile) {
                case 'csv':
                    $this->profiles['csv']->import($source);
                    return Cli::RETURN_SUCCESS;
                case 'json':
                    $this->profiles['json']->import($source);
                    return Cli::RETURN_SUCCESS;
                default:
                    $output->writeln('<error>Invalid profile. Supported profiles: csv, json</error>');
                    return Cli::RETURN_FAILURE;
            }
        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return Cli::RETURN_FAILURE;
        }
    }
}
