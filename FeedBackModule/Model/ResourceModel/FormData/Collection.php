<?php
namespace CustomFeedBack\FeedBackModule\Model\ResourceModel\FormData;

/**
 * Class Collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'feedback_id';
    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(
            \CustomFeedBack\FeedBackModule\Model\FormData::class,
            \CustomFeedBack\FeedBackModule\Model\ResourceModel\FormData::class
        );
    }
}
