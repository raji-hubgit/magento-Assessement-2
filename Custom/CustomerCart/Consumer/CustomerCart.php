<?php

namespace Custom\CustomerCart\Consumer;

use _PHPStan_76800bfb5\Composer\CaBundle\CaBundle;
use Magento\Framework\Serialize\SerializerInterface;
use Custom\CustomerCart\Model\CartModelFactory as CartModel;
use Custom\CustomerCart\Model\ResourceModel\CartModel as CartResourceModel;

class CustomerCart
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var CartModel
     */
    protected $cartModel;

    /**
     * @var CartResourceModel
     */
    protected $cartResourceModel;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(
        SerializerInterface $serializer,
        CartModel $cartModel,
        CartResourceModel $cartResourceModel
    ) {
        $this->serializer = $serializer;
        $this->cartModel = $cartModel;
        $this->cartResourceModel = $cartResourceModel;
    }

    /**
     * @param $data
     * @return void
     */
    public function consume($data)
    {
        $cartModel = $this->cartModel->create();
        $dataarray = $this->serializer->unserialize($data);
        $cartModel->setData($dataarray);
        try {
            $this->cartResourceModel->save($cartModel);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
