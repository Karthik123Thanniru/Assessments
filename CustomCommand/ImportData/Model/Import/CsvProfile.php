<?php

declare(strict_types=1);

namespace CustomCommand\ImportData\Model\Import;

use Psr\Log\LoggerInterface;
use CustomCommand\ImportData\Api\ProfileInterface;
use Magento\Framework\File\Csv;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Data\CustomerFactory;

class CsvProfile implements ProfileInterface
{
    
    /**
     * CsvProfile constructor.
     *
     * @param Csv                         $csv
     * @param CustomerRepositoryInterface $customerRepository
     * @param CustomerFactory             $customerFactory
     * @param LoggerInterface             $logger
     */
    public function __construct(
        protected Csv $csv,
        protected CustomerRepositoryInterface $customerRepository,
        protected CustomerFactory $customerFactory,
        protected LoggerInterface $logger
    ) {}

    /**
     * Import data from a source
     *
     * @param string $source The source path or location
     * @return void
     */
    public function import($source)
    {
        $csvData = array_map('str_getcsv', file($source));
        array_shift($csvData);
        $this->importCustomers($csvData);
    }

    /**
     * Import customers from CSV data
     *
     * @param array $csvData The CSV data
     * @return void
     */
    protected function importCustomers(array $csvData)
    {
        foreach ($csvData as $row) {
            list($firstname, $lastname, $email) = $row;
            $customer = $this->customerFactory->create();
            $customer->setFirstname($firstname);
            $customer->setLastname($lastname);
            $customer->setEmail($email);
            $this->customerRepository->save($customer);
            $this->logger->info('imported successfully');
        }
    }
}
