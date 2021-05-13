<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By : Anjulata Gupta
 */
namespace Trybugs\Banner\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Trybugs\Banner\Model\Banner as BannerModel;
use Trybugs\Banner\Model\ResourceModel\Banner as BannerResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(BannerModel::class, BannerResourceModel::class);
    }
}