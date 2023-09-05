<?php

namespace CustomFeedBack\FeedBackModule\Block\Adminhtml;

use CustomFeedBack\FeedBackModule\Model\FormDataFactory;
use Magento\Backend\Block\Template;
use Magento\Backend\Block\Widget\Button\ButtonList;
use Magento\Framework\UrlInterface;

class View extends Template
{

    protected $_request;

    protected $_coreRegistry;

    protected $_modelDataFactory;

    protected $_buttonList;

    protected $_url;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Registry $registry,
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
        // return $this->request->getParam('id');
        $data = $this->_modelDataFactory->create()->load($this->_request->getParam('id'));
        return $data;
    }




}