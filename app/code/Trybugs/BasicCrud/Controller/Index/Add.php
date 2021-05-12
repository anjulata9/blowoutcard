<?php

declare(strict_types=1);

namespace Trybugs\BasicCrud\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
class Add extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_request;
    protected $_coreRegistry;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,        
        \Magento\Framework\View\Result\PageFactory $pageFactory,        
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Registry $coreRegistry
        
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_request = $request;
        $this->_coreRegistry = $coreRegistry;

        return parent::__construct($context);
    }
    /**
     * Add contact action
     *
     * @return void
     */
    public function execute()
    {
       
        return $this->_pageFactory->create();

    }
}