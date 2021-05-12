<?php

declare(strict_types=1);

namespace Trybugs\BasicCrud\Block;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Config;
use Magento\Framework\App\Filesystem\DirectoryList;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $_pageFactory;

    protected $_contactFactory;

    protected $_filesystem;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Trybugs\BasicCrud\Model\CustomContactFactory $contactFactory,
        \Magento\Framework\Filesystem $filesystem
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_contactFactory = $contactFactory;
         $this->_filesystem = $filesystem;
        return parent::__construct($context);
    }

   
    
    public function getPostData()
    {
        $contact = $this->_contactFactory->create();
        $collection = $contact->getCollection();
        /*foreach($collection as $item){
            echo "<pre>";
            print_r($item->getData());
            echo "</pre>";
        }
        exit();*/
//        return $this->_pageFactory->create();
        return $collection->getData();
    }
    public function getAddUrl()
    {            
        return $this->getUrl('customcontact/index/add');
       
    }
    public function getEditUrl($id)
    {       
        return $this->getUrl('customcontact/index/add', ['id' => $id]);
    }
    public function getDeleteUrl($id)
    {  
        return $this->getUrl('customcontact/index/delete', ['id' => $id]);
    }
    public function getMediaPath()
    {
        return $this->getUrl('pub/media/trybugs_images');
    }
    
}
