<?php

namespace Custom\CustomerCart\Model\View;

use Magento\Framework\DataObject;
use Custom\CustomerCart\Api\Data\CartInterface;

class Cart extends DataObject implements CartInterface
{


    /**
     * @param  integer $id
     * @return $this
     */
    public function setId(int $id)
    {
        return $this->setData(self::ID, $id);

    }//end setId()


    /**
     * @param  string $sku
     * @return $this
     */
    public function setSku(string $sku)
    {
        return $this->setData(self::SKU, $sku);

    }//end setSku()


    /**
     * @param  int|null $customerId
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);

    }//end setCustomerId()


    /**
     * @param  integer $quoteId
     * @return $this
     */
    public function setQuoteId(int $quoteId)
    {
        return $this->setData(self::QUOTE_ID, $quoteId);

    }//end setQuoteId()


    /**
     * @param  string $created
     * @return $this
     */
    public function setCreated(string $created)
    {
        return $this->setData(self::CREATED, $created);

    }//end setCreated()


    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->getData(self::ID);

    }//end getId()


    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->getData(self::SKU);

    }//end getSku()


    /**
     * @return int|null
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);

    }//end getCustomerId()


    /**
     * @return integer
     */
    public function getQuoteId(): int
    {
        return $this->getData(self::QUOTE_ID);

    }//end getQuoteId()


    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->getData(self::CREATED);

    }//end getCreated()


}//end class
