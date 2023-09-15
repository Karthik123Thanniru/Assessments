<?php

namespace CustomCommand\ImportData\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use CustomCommand\ImportData\Model\CustomerDataFactory;

class FileDataImporter extends Command
{
    private const PROFILE = 'profile';

    protected $dataFactory;

    public function __construct(CustomerDataFactory $dataFactory)
    {
        $this->dataFactory = $dataFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $options = [
            new InputOption(
                self::PROFILE,
                '-s',
                InputOption::VALUE_REQUIRED,
                'Say the file extention'
            ),
        ];
        $this->setName('customer:importer')
            ->setDescription('Import customer data')
            ->setDefinition($options)
            ->addArgument('sourcePath', InputArgument::REQUIRED, 'Give source path');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $source = (string)$input->getArgument('sourcePath');
        $profile = $input->getOption('profile');
        $output->writeln("Profile: $profile");
        $output->writeln("Source: $source");
        if ($sourceExtension = pathinfo($source, PATHINFO_EXTENSION)) {
            switch ($sourceExtension) {
                case 'json':
                    $jsonData = $this->readJsonData($source, $output);
                    $this->processJsonData($jsonData);
                    return 0;
                    break;
                case 'csv':
                    $this->readCsvData($source, $output);
                    return 0;
                    break;
                default:
                    $output->writeln("<error>Unsupported file format: $sourceExtension</error>");
                    return Command::FAILURE;
            }
        } else {
            $output->writeln("<error>Invalid file extension.</error>");
            return Command::FAILURE;
        }
        $output->writeln("<info>Data not loaded successfully.</info>");
        return Command::SUCCESS;
    }

    protected function readJsonData($source, OutputInterface $output)
    {
        $jsonContent = file_get_contents($source);
        $jsonData = json_decode($jsonContent, true);
        if ($jsonData === null) {
            $output->writeln("<error>Error parsing JSON file.</error>");
            return 1;
        }
        $output->writeln("<info>Data loaded successfully.</info>");
        return $jsonData;
    }

    protected function readCsvData($source, OutputInterface $output)
    {
        $csvData = array_map('str_getcsv', file($source));
        $csvHeaders = array_shift($csvData);
        if ($csvData === false) {
            $output->writeln("<error>Error reading CSV file.</error>");
            return 1;
        }
        $output->writeln("<info>Data loaded successfully.</info>");
        $this->processCsvData($csvData, $csvHeaders);
        return 0;
    }

    protected function processJsonData($jsonData)
    {
        foreach ($jsonData as $data) {
            $this->saveCustomerToDatabase($data);
        }
    }

    protected function processCsvData($csvData, $csvHeaders)
    {
        foreach ($csvData as $row) {
            if (count($row) !== count($csvHeaders)) {
                $output->writeln("<error>Invalid CSV row:</error>");
                $output->writeln(implode(', ', $row));
                continue;
            }
            $data = array_combine($csvHeaders, $row);
            $this->saveCustomerToDatabase($data);
        }
    }

    protected function saveCustomerToDatabase($data)
    {
        $mappedData = [
            'firstname' => $data['fname'],
            'lastname' => $data['lname'],
            'email' => $data['emailaddress'],
        ];
        $customerModel = $this->dataFactory->create();
        $customerModel->setData($mappedData);
        $customerModel->save();
    }
}
