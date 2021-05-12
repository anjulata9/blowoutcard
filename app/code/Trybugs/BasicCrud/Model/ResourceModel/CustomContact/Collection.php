<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Trybugs\BasicCrud\Model\ResourceModel\CustomContact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{
    protected function _construct()
    {
        $this->_init('Trybugs\BasicCrud\Model\CustomContact', 'Trybugs\BasicCrud\Model\ResourceModel\CustomContact');
    }
}
