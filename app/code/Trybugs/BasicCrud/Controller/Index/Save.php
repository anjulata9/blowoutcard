<?php
declare(strict_types=1);
namespace Trybugs\BasicCrud\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Trybugs\BasicCrud\Model\CustomContactFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Filesystem; 
use Magento\Framework\App\Filesystem\DirectoryList;
class Save extends Action
{

    protected $_modelCustomContactFactory;
    protected $resultPageFactory;
    protected $_sessionManager;
    protected $_filesystem;

    public function __construct(
        Context $context,
        CustomContactFactory $modelPostFactory,
        PageFactory  $resultPageFactory,
        SessionManagerInterface $sessionManager,
        \Magento\Framework\Filesystem $fileSystem
    )
    {
        parent::__construct($context);
        $this->_modelCustomContactFactory = $modelPostFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_sessionManager = $sessionManager;
        $this->_filesystem = $fileSystem;
    }

    public function execute()
    {
        try{
        $resultRedirect     = $this->resultRedirectFactory->create();
        $data               = $this->getRequest()->getPost();
       
        // $resultRedirect     = $this->resultRedirectFactory->create();
        if(isset($data['id'])){            
            $customContactModel = $this->_modelCustomContactFactory->create()->load($data['id']);
        }else{
            $customContactModel = $this->_modelCustomContactFactory->create();
        }

        $result = array();
        if ($_FILES['image']['name']) {
            try {
                // init uploader model.
                $uploader = $this->_objectManager->create(
                    'Magento\MediaStorage\Model\File\Uploader',
                    ['fileId' => 'image']
                );
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                // get media directory
                $mediaDirectory = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA);
                
               // $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('tem/trybugs_images/');
                // save the image to media directory
                $result = $uploader->save($mediaDirectory->getAbsolutePath('trybugs_images/'));
                //print_r($result);exit;
            } catch (Exception $e) {
                \Zend_Debug::dump($e->getMessage());
            }
            //$path = substr($result['name'],0,1)."/". substr($result['name'],1,1)."/". $result['name'];
            $customContactModel->setData('image', $result['file']);
        }
     
        $customContactModel->setData('name', $data['name']);
        $customContactModel->setData('content', $data['content']);
        $customContactModel->setData('mobile', $data['mobile']);
        $customContactModel->setData('status', $data['status']);
        $customContactModel->setData('date', $data['date']);       
       // $customContactModel->setData($data);

        $customContactModel->save();

        $this->_redirect('customcontact/index');
        $this->messageManager->addSuccessMessage(__('The contact has been saved.'));
    }catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t add record, Please try again."));
        }
    }
}
