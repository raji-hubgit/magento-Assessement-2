<?php

namespace Custom\CustomerCart\Model\Api;

use Custom\CustomerCart\Api\Data\CartInterfaceFactory;
use Custom\CustomerCart\Api\CustomInterface;
use Custom\CustomerCart\Model\ResourceModel\CartModel\CollectionFactory;
use Custom\CustomerCart\Model\CartModelFactory as CartModel;
use Custom\CustomerCart\Model\ResourceModel\CartModel as CartResourceModel;
use Magento\Framework\App\ResourceConnection;

class Custom implements CustomInterface
{

    /**
     * @var cartInterfaceFactory
     */
    protected $cartInterfaceFactory;

    /**
     * @var collectionFactory
     */
    protected $collectionFactory;

    /**
     * @var cartModel
     */
    protected $cartModel;

    /**
     * @var cartResourceModel
     */
    protected $cartResourceModel;

    /**
     * @var resourceConnection
     */
    protected $resourceConnection;

    /**
     * @param CartInterfaceFactory $cartInterfaceFactory
     * @param CollectionFactory    $collectionFactory
     * @param CartModel            $cartModel
     * @param CartResourceModel    $cartResourceModel
     * @param ResourceConnection   $resourceConnection
     */


    public function __construct(
        CartInterfaceFactory $cartInterfaceFactory,
        CollectionFactory $collectionFactory,
        CartModel $cartModel,
        CartResourceModel $cartResourceModel,
        ResourceConnection $resourceConnection
    ) {
        $this->cartInterfaceFactory = $cartInterfaceFactory;
        $this->collectionFactory    = $collectionFactory;
        $this->cartModel            = $cartModel;
        $this->cartResourceModel    = $cartResourceModel;
        $this->resourceConnection   = $resourceConnection;

    }//end __construct()


    /**
     * get cart Api data.
     *
     * @api
     *
     * @param integer|null $page
     *
     * @return \Custom\CustomerCart\Api\Data\CartInterface
     */
    public function getCartItems(int $page=null)
    {
        try {
            $data = [];
            $cart = $this->collectionFactory->create()->setPageSize(5)->setCurPage($page);
            foreach ($cart as $item) {
                $cartInterface = $this->cartInterfaceFactory->create();
                $cartInterface->setId($item->getId());
                $cartInterface->setSku($item->getSku());
                $cartInterface->setCustomerId($item->getCustomerId());
                $cartInterface->setQuoteId($item->getQuoteId());
                $cartInterface->setCreated($item->getCreated());
                $data[] = $cartInterface;
            }

            return $data;
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }

    }//end getCartItems()


    /**
     * @param  integer $id
     * @return \Custom\CustomerCart\Api\Data\CartInterface[]
     */
    public function getCartById(int $id)
    {
        try {
            $cartModel = $this->cartModel->create();
            $this->cartResourceModel->load($cartModel, $id, 'id');
            $cartModel->getData();

            $cartInterface = $this->cartInterfaceFactory->create();
            $cartInterface->setId($cartModel->getId());
            $cartInterface->setSku($cartModel->getSku());
            $cartInterface->setCustomerId($cartModel->getCustomerId());
            $cartInterface->setQuoteId($cartModel->getQuoteId());
            $cartInterface->setCreated($cartModel->getCreated());
            $data[] = $cartInterface;
            return $data;
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }

    }//end getCartById()


    /**
     * @param  integer $id
     * @param  integer $customerId
     * @return \Custom\CustomerCart\Api\Data\CartInterface[]
     */
    public function getCartUpdate(int $id, int $customerId=null)
    {
        try {
            $cartModel = $this->cartModel->create();
            $this->cartResourceModel->load($cartModel, $id, 'id');

            if ($customerId !== null) {
                $cartModel->setCustomerId($customerId);
            }

            $this->cartResourceModel->save($cartModel);
            // $data[]=$cartModel;
            return [
                'success' => true,
                'message' => 'updated successfully',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }//end try

    }//end getCartUpdate()


    /**
     * @param  string       $sku
     * @param  integer|null $customerId
     * @param  integer      $quoteId
     * @param  string       $created
     * @return \Custom\CustomerCart\Api\Data\CartInterface[]
     */
    public function getCartInsert(string $sku, int $customerId=null, int $quoteId, string $created)
    {
        try {
            $cartModel = $this->cartModel->create();

            $cartModel->setSku($sku);
            $cartModel->setQuoteId($quoteId);
            $cartModel->setCreated($created);

            if ($customerId !== null) {
                $cartModel->setCustomerId($customerId);
            }

            $this->cartResourceModel->save($cartModel);
            // $data[]=$cartModel;
            return [
                'success' => true,
                'message' => 'updated successfully',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }//end try

    }//end getCartInsert()


}//end class
