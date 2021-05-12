<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Trybugs\BasicCrud\Model;
use Magento\Framework\Model\AbstractModel;

class CustomContact extends \Magento\Framework\Model\AbstractModel {

    protected function _construct() {
        $this->_init('Trybugs\BasicCrud\Model\ResourceModel\CustomContact');
    }
}
