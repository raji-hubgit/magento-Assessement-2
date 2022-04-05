<?php

namespace Custom\CustomerCart\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Http\Context;
use Custom\CustomerCart\Model\CartModelFactory as CartModel;
use Custom\CustomerCart\Model\ResourceModel\CartModel as CartResourceModel;
use \Magento\Framework\Event\Observer;
use Magento\Checkout\Model\Session;
use Custom\CustomerCart\Publisher\CustomerCart;

class ProductInterface implements ObserverInterface
{

    /**
     * @var Context
     */
    protected $context;

    /**
     * @var CartModel
     */
    protected $cartModel;

    /**
     * @var CartResourceModel
     */
    protected $cartResourceModel;

    /**
     * @var Session
     */
    private $checkoutSession;

    /**
     * @var publisher
     */
    protected $publisher;


    /**
     * @param CartModel         $cartModel
     * @param CartResourceModel $cartResourceModel
     * @param Context           $context
     * @param Session           $checkoutSession
     * @param CustomerCart      $publisher
     */
    public function __construct(
        CartModel $cartModel,
        CartResourceModel $cartResourceModel,
        Context $context,
        Session $checkoutSession,
        CustomerCart $publisher

    ) {
        $this->cartModel         = $cartModel;
        $this->cartResourceModel = $cartResourceModel;
        $this->context           = $context;
        $this->checkoutSession   = $checkoutSession;
        $this->publisher         = $publisher;

    }//end __construct()


    public function execute(Observer $observer)
    {
        // TODO: Implement execute() method.
        $quote   = $this->checkoutSession->getQuote();
        $quoteId = $quote->getId();

        $customerId = $this->context->getValue('customer_id');
        if ($customerId == 0) {
            $customerId = null;
        }

        $cartProduct     = $observer->getProduct();
        $sku             = $cartProduct->getsku();
        $createdAt       = $quote->getCreatedAt();
        $customCartModel = $this->cartModel->create();
        $customCartModel->setSku($sku)->setQuoteId($quoteId)->setCustomerId($customerId)->setCreatedAt($createdAt);
        $this->cartResourceModel->save($customCartModel);

        $cartProductArray=['sku'=>$sku,'customer_id'=>$customerId,'quote_id'=>$quoteId];
        $this->publisher->publish($cartProductArray);

    }//end execute()


}//end class
