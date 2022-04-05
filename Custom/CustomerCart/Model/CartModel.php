<?php

namespace Custom\CustomerCart\Model;

use Magento\Framework\Model\AbstractModel;

class CartModel extends AbstractModel
{
    /**
     * Post Initialization
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Custom\CustomerCart\Model\ResourceModel\CartModel');
    }


}
