<?php
namespace Trybugs\Banner\Block;
 
class HomePage extends \Magento\Framework\View\Element\Template
{
	 protected $_bannerFactory;

	 public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Trybugs\Banner\Model\BannerFactory $bannerFactory,
        \Magento\Framework\Filesystem $filesystem
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_bannerFactory = $bannerFactory;
         $this->_filesystem = $filesystem;
        return parent::__construct($context);
    }


    public function getMessage()
    {
        $msg = "Hello World";
        return $msg;
    }

    public function getPostData()
    {
        $banner = $this->_bannerFactory->create();
        $collection = $banner->getCollection();
        
        return $collection->getData();
    }
}