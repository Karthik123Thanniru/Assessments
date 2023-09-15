<?php
namespace CustomCommand\ImportData\Model\ResourceModel\CustomerData;

/**
 * Class Collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(
            \CustomCommand\ImportData\Model\CustomerData::class,
            \CustomCommand\ImportData\Model\ResourceModel\CustomerData::class
        );
    }

    
}
