<?php

namespace Custom\CustomerCart\Model\ResourceModel\CartModel;

use Custom\CustomerCart\Model\CartModel;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{


    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CartModel::class, \Custom\CustomerCart\Model\ResourceModel\CartModel::class);

    }//end _construct()


}//end class
