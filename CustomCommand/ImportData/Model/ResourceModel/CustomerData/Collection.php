<?php

namespace CustomCommand\ImportData\Model\ResourceModel\CustomerData;

use CustomCommand\ImportData\Model\CustomerData as CustomerData;
use CustomCommand\ImportData\Model\ResourceModel\CustomerData as ResourceModelCustomerData;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(
            CustomerData::class,
            ResourceModelCustomerData::class
        );
    }
}
    