<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Trybugs\BasicCrud\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class CustomContact extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('trybug_contacts', 'id');
    }
}
