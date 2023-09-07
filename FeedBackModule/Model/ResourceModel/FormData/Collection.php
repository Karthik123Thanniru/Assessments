<?php
namespace CustomFeedBack\FeedBackModule\Model\ResourceModel\FormData;
use CustomFeedBack\FeedBackModule\Model\FormData as FormData;
use CustomFeedBack\FeedBackModule\Model\ResourceModel\FormData as ResourceModelFormData;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'feedback_id';

    protected function _construct() 
    {
        $this->_init(
            FormData::class,
            ResourceModelFormData::class
        );
    }
}
