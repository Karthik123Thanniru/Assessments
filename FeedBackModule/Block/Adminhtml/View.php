<?php

namespace CustomFeedBack\FeedBackModule\Block\Adminhtml;
use CustomFeedBack\FeedBackModule\Model\FormDataFactory;
use Magento\Backend\Block\Template;
use Magento\Backend\Block\Widget\Button\ButtonList;
use Magento\Framework\UrlInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Registry;
class View extends Template
{
    protected $_request;
    protected $_coreRegistry;
    protected $_modelDataFactory;
    protected $_buttonList;
    protected $_url;
    public function __construct(
        Context $context,
        Http $request,
        Registry $registry,
        FormDataFactory $DataFactory,
        UrlInterface $url,
        ButtonList $buttonList,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_modelDataFactory = $DataFactory;
        $this->_request = $request;
        $this->_buttonList = $buttonList;
        $this->_url = $url;
        parent::__construct($context, $data);
    }

    public function getDbData()
    {
        $data = $this->_modelDataFactory->create()->load($this->_request->getParam('id'));
        return $data;
    }




}