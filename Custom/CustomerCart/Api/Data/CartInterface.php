<?php

namespace Custom\CustomerCart\Api\Data;

//use Magento\Tests\NamingConvention\true;

interface CartInterface
{
    /**
* #@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID          = 'id';
    const SKU         = 'sku';
    const CUSTOMER_ID = 'customer_id';
    const QUOTE_ID    = 'quote_id';
    const CREATED     = 'created';
    /**
     * #@-
     */


    /**
     * Get ID
     *
     * @return integer|null
     */
    public function getId(): ?int;


    /**
     * Get Sku
     *
     * @return string|null
     */
    public function getSku(): ?string;


    /**
     * Get Customer id
     *
     * @return int|null
     */
    public function getCustomerId();


    /**
     * Get Quote id
     *
     * @return integer|null
     */
    public function getQuoteId(): ?int;


    /**
     * Get Created
     *
     * @return string|null
     */
    public function getCreated(): ?string;


    /**
     * Set ID
     *
     * @param  integer $id
     * @return $this
     */
    public function setId(int $id);


    /**
     * Set Sku
     *
     * @param  string $sku
     * @return $this
     */
    public function setSku(string $sku);


    /**
     * Set Customer id
     *
     * @param  int|null $customerId
     * @return $this
     */
    public function setCustomerId($customerId);


    /**
     * Set Quote id
     *
     * @param  integer $quoteId
     * @return $this
     */
    public function setQuoteId(int $quoteId);


    /**
     * Set Created
     *
     * @param  string $created
     * @return $this
     */
    public function setCreated(string $created);


}//end interface
