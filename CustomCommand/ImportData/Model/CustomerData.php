<?php

namespace CustomCommand\ImportData\Model;

use Magento\Framework\Model\AbstractModel;
use CustomCommand\ImportData\Model\ResourceModel\CustomerData as CustomerDataResource;

class CustomerData extends AbstractModel
{

    protected function _construct()
    {
        $this->_init(CustomerDataResource::class);
    }
}
