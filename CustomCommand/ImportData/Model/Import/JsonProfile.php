<?php

declare(strict_types=1);

namespace CustomCommand\ImportData\Model\Import;

use Psr\Log\LoggerInterface;
use CustomCommand\ImportData\Api\ProfileInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Customer\Model\ResourceModel\Customer as CustomerRepositoryInterface;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Serialize\SerializerInterface;

/**
 * Class JsonProfile
 * @package CustomCommand\ImportData\Model\Import
 */
class JsonProfile implements ProfileInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * JsonProfile constructor.
     *
     * @param CustomerFactory             $customerFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param LoggerInterface             $logger
     * @param SerializerInterface         $serializer
     */
    public function __construct(
        CustomerFactory $customerFactory,
        CustomerRepositoryInterface $customerRepository,
        LoggerInterface $logger,
        SerializerInterface $serializer
    ) {
        $this->customerFactory = $customerFactory;
        $this->customerRepository = $customerRepository;
        $this->logger = $logger;
        $this->serializer = $serializer;
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
            $jsonData = file_get_contents($source);
            $data = $this->serializer->unserialize($jsonData);
            $this->importCustomers($data);
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
        }
    }

    /**
     * Import customers from JSON data
     *
     * @param array $customerDataArray The JSON data
     * @return void
     */
    protected function importCustomers(array $customerDataArray)
    {
        foreach ($customerDataArray as $customerData) {
            $customer = $this->customerFactory->create();
            $customer->setFirstname($customerData['fname']);
            $customer->setLastname($customerData['lname']);
            $customer->setEmail($customerData['emailaddress']);
            $this->customerRepository->save($customer);
            $this->logger->info('imported successfully');
        }
    }
}
