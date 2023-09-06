<?php
namespace CustomFeedBack\FeedBackModule\Controller\Index;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;

class Index extends Action
{
    protected $resultPageFactory;
    protected $customerSession;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Session $customerSession
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->customerSession = $customerSession;
        parent::__construct($context);
    } 
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        if ($this->customerSession->isLoggedIn()) {
            $resultPage->getLayout()->getBlock('feedbackform')->setData('customer_session', $this->customerSession);
        } 
        return $resultPage;
    }
}
