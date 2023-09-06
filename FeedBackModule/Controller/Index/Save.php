<?php
namespace CustomFeedBack\FeedBackModule\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session as CustomerSession;
use CustomFeedBack\FeedBackModule\Model\FormDataFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Save extends Action
{
    protected $resultRedirectFactory;
    protected $dataFactory;
    protected $customerSession;
    public function __construct(
        Context $context,
        RedirectFactory $resultRedirectFactory,
        FormDataFactory $dataFactory,
        CustomerSession $customerSession
    ) {
        parent::__construct($context);
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->dataFactory = $dataFactory;
        $this->customerSession = $customerSession;
    }

    public function execute()
    {
        $customerId = $this->customerSession->getCustomerId();
        if ($customerId) {
            $postData = $this->getRequest()->getPostValue();
            $formData = [
                'customer_id' => $customerId,
                'firstname' => $postData['firstname'],
                'lastname' => $postData['lastname'],
                'email' => $postData['email'],
                'comment' => $postData['comment'],
                'validation' => 'validating',
            ];
            $model = $this->dataFactory->create();
            try {
                $model->setData($formData)->save();
                $this->messageManager->addSuccessMessage(__('Sent for review successfully'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Sent for review failed: ' . $e->getMessage()));
            }
        } else {
            $resultRedirect = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(__('logged in required'));
            $resultRedirect->setPath('customer/account/login');
            return $resultRedirect;
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('/');
        return $resultRedirect;
    }
}