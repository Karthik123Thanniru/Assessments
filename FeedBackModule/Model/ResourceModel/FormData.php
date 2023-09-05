<?php
namespace  CustomFeedBack\FeedBackModule\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class FormData extends AbstractDb
{    /**     * @inheritdoc     */   
     protected function _construct()   
      {        
        $this->_init('feedback_data', 'feedback_id');  
      }
    
}