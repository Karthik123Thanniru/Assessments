<?php

namespace CustomFeedBack\FeedBackModule\Controller\Adminhtml\Post;
use CustomFeedBack\FeedBackModule\Helper\Mail;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use CustomFeedBack\FeedBackModule\Model\FormDataFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use CustomFeedBack\FeedBackModule\Model\ResourceModel\FormData;

class Validation extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $formDataFactory;
    protected $jsonFactory;
    protected $formDataResource;
    protected $_helperMail;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        FormDataFactory $formDataFactory,
        JsonFactory $jsonFactory,
        FormData $formDataResource,
        Mail $helperMail
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->formDataFactory = $formDataFactory;
        $this->jsonFactory = $jsonFactory;
        $this->formDataResource = $formDataResource;
        $this->_helperMail = $helperMail;
    }
    
    public function execute()
    {
        $id = $this->getRequest()->getParam('id'); // Get the 'id' parameter from the request
        
        // Update the "validation" column from "validating" to "validated" for the specified feedback_id
        $data = [
            'validation' => 'validated', // New value
        ];
        
        try {
            $formData = $this->formDataFactory->create();
            $this->formDataResource->load($formData, $id); // Load the data model
            $formData->addData($data);
            $this->formDataResource->save($formData); // Save the updated data
            $this->_helperMail->sendEmail('karthikthanniru29@gmail.com');
            $result = $this->jsonFactory->create()->setData(['success' => true]);
        } catch (\Exception $e) {
            $result = $this->jsonFactory->create()->setData(['error' => $e->getMessage()]);
        }

        return $result;
    }
}
