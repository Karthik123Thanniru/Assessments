<?php
namespace CustomFeedBack\FeedBackModule\Model;
use Magento\Framework\Model\AbstractModel;
use  CustomFeedBack\FeedBackModule\Model\ResourceModel\FormData as FormDataResource;
class FormData extends AbstractModel
{
protected function _construct()
{
    $this->_init(FormDataResource::class);
}
}