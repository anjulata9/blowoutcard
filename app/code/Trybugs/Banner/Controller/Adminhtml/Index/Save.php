<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By : Anjulata Gupta
 */
namespace Trybugs\Banner\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Trybugs\Banner\Model\Banner;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var Banner
     */
    protected $trybugsBannermodel;

    /**
     * @var Session
     */
    protected $adminsession;

    /**
     * @param Action\Context $context
     * @param Banner         $trybugsBannermodel
     * @param Session        $adminsession
     */
    public function __construct(
        Action\Context $context,
        Banner $trybugsBannermodel,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->trybugsBannermodel = $trybugsBannermodel;
        $this->adminsession = $adminsession;
    }

    /**
     *
     * Save banner record action
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $data['image_name'] = $data['image_name'][0]['url'];
        /*echo "<pre>";
        print_r($data);*/
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $banner_id = $this->getRequest()->getParam('id');
            if ($banner_id) {
                $this->trybugsBannermodel->load($banner_id);
            }
           

            $this->trybugsBannermodel->setData($data);

            try {
                $this->trybugsBannermodel->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['id' => $this->trybugsBannermodel->getId(), '_current' => true]);
                    }
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}