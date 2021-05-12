<?php

declare(strict_types=1);

namespace Trybugs\BasicCrud\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    
    public function __construct(
       \Magento\Framework\App\Action\Context $context
    )
    {
       
       return parent::__construct($context);
    }

    public function execute()
    {        
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
