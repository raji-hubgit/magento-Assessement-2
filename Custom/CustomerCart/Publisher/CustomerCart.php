<?php

namespace Custom\CustomerCart\Publisher;

use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\SerializerInterface;

class CustomerCart
{
    const TOPIC_NAME ="customercart.topic";

    /**
     * @var PublisherInterface
     */
    private $publisher;

    /**
     * @var SerializerInterface
     */
    private $serializer;


    /**
     * @param PublisherInterface $publisher
     * @param SerializerInterface $serializer
     */
    public function __construct(
        PublisherInterface  $publisher,
        SerializerInterface  $serializer
    ) {
        $this->publisher = $publisher;
        $this->serializer = $serializer;
    }

    /**
     * @param array $data
     * @return mixed|null
     */
    public function publish(array $data)
    {
        return $this->publisher->publish(self::TOPIC_NAME, $this->serializer->serialize($data));
    }
}
