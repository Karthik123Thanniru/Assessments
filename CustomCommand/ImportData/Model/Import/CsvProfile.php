<?php

declare(strict_types=1);

namespace CustomCommand\ImportData\Model\Import;

use Psr\Log\LoggerInterface;
use CustomCommand\ImportData\Api\ProfileInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\File\Csv;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\ResourceModel\Customer as ResourceModel;

/**
 * Class CsvProfile
 * @package CustomCommand\ImportData\Model\Import
 */
class CsvProfile implements ProfileInterface
{
    /**
     * @var Csv
     */
    protected $csv;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var ResourceModel
     */
    protected $customerRepository;

    /**
     * CsvProfile constructor.
     *
     * @param Csv             $csv
     * @param ResourceModel   $customerRepository
     * @param CustomerFactory $customerFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        Csv $csv,
        ResourceModel $customerRepository,
        CustomerFactory $customerFactory,
        LoggerInterface $logger
    ) {
        $this->csv = $csv;
        $this->customerFactory = $customerFactory;
        $this->customerRepository = $customerRepository;
        $this->logger = $logger;
    }

    /**
     * Import data from a source
     *
     * @param string $source The source path or location
     * @return void
     */
    public function import($source)
    {
        try {
            $csvData = array_map('str_getcsv', file($source));
            $this->importCustomers($csvData);
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
        }
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
