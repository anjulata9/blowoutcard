<?php

namespace Trybugs\BasicCrud\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Trybugs\BasicCrud\Model\CustomContactFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

class Delete extends Action
{
    protected $resultPageFactory;
    protected $customContactFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CustomContactFactory $customContactFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->customContactFactory = $customContactFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getParams();
            if ($data) {
                $model = $this->customContactFactory->create()->load($data['id']);
                $model->delete();
                
                $this->messageManager->addSuccessMessage(__("Record Deleted Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t delete record, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;

    }
}