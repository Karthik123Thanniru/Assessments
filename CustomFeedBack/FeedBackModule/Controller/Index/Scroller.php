<?php
namespace CustomFeedBack\FeedBackModule\Controller\Index;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use CustomFeedBack\FeedBackModule\Model\FormDataFactory;
class Scroller extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $feedbackFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        FormDataFactory $feedbackFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->feedbackFactory = $feedbackFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $feedbackCollection = $this->feedbackFactory->create()->getCollection();
        $feedbackCollection->addFieldToFilter('validation', 'validated');
        $resultPage = $this->resultPageFactory->create();
        $blockInstance = $resultPage->getLayout()->getBlock('feedbackdisplay');
        if ($blockInstance) {
            $blockInstance->setData('feedback_data', $feedbackCollection);
        }
        return $resultPage;
    }
}
