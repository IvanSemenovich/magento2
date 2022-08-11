<?php

namespace Overdose\Reviews\Controller\Reviews;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Overdose\Reviews\Model\ReviewFactory;

class ReviewSave extends Action
{
    protected $resultPageFactory;
    protected $reviewFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ReviewFactory $reviewFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->reviewFactory = $reviewFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getPost();
            if ($data) {
                if (empty($data["customer_id"])) {
                    unset($data["customer_id"]);
                }
                $model = $this->reviewFactory->create();
                $model->setData($data)->save();
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
