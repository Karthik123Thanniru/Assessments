<?php
namespace  CustomCommand\ImportData\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class CustomerData extends AbstractDb
{    /**     * @inheritdoc     */   
     protected function _construct()   
      {        
        $this->_init('customer_entity', 'entity_id');  
      }
    
}