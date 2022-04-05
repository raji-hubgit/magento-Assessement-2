<?php
namespace Custom\CustomerCart\Api;

interface CustomInterface
{


    /**
     * GET for Post api
     *
     * @param  integer|null $page
     * @return \Custom\CustomerCart\Api\Data\CartInterface[]
     */
    public function getCartItems(int $page=null);


    /**
     * @param  integer $id
     * @return \Custom\CustomerCart\Api\Data\CartInterface[]
     */
    public function getCartById(int $id);


    /**
     * @param  integer $id
     * @param  integer|null $customerId
     * @return \Custom\CustomerCart\Api\Data\CartInterface[]
     */
    public function getCartUpdate(int $id, int $customerId=null);


    /**
     * @param  string       $sku
     * @param  integer|null $customerId
     * @param  integer      $quoteId
     * @param  string       $created
     * @return \Custom\CustomerCart\Api\Data\CartInterface[]
     */
    public function getCartInsert(string $sku, int $customerId=null, int $quoteId, string $created);


}//end interface
