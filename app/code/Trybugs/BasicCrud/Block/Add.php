<?php

declare(strict_types=1);

namespace Trybugs\BasicCrud\Block;
//use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\Controller\Result\RedirectFactory;
//use Magento\Framework\View\Element\Template;
use Trybugs\BasicCrud\Model\CustomContactFactory;
class Add extends \Magento\Framework\View\Element\Template
{
    protected $formKey;
    protected $_pageFactory;
    protected $_coreRegistry;
    protected $_contactLoader;
    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Trybugs\BasicCrud\Model\CustomContactFactory $contactLoader,
        FormKey $formKey,
        array $data = []
    )
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->formKey = $formKey;

        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_contactLoader = $contactLoader;

        parent::__construct($context, $data);
    }
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
    /**
     * Get form action URL for contact add request
     *
     * @return string
     */
    public function getFormAction()
    {
        // companymodule is given in routes.xml
        // controller_name is folder name inside controller folder
        // action is php file name inside above controller_name folder

        return $this->getUrl('customcontact/index/save');
        // here controller_name is index, action is add
    }
    
    public function getEditRecord()
    {
        $contactid = $this->_request->getParam('id');        
        $contact = $this->_contactLoader->create();
        $collection = $contact->getCollection()->addFieldToFilter('id', $contactid);
        //print_r($collection->getData());exit;
        return $collection->getData();
    }
}
