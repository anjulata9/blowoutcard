<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By : Anjulata Gupta
 */
namespace Trybugs\Banner\Model;

use Magento\Framework\Model\AbstractModel;
use Trybugs\Banner\Model\ResourceModel\Banner as BannerResourceModel;

class Banner extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(BannerResourceModel::class);
    }
}