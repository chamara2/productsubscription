<?php

namespace CoolC\ProductSubscription\Model;

use CoolC\ProductSubscription\Api\Data\SubscriptionInterface;
use CoolC\ProductSubscription\Api\Data\SubscriptionInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

/**
 * Class Subscription
 * @package CoolC\ProductSubscription\Model
 */
class Subscription extends \Magento\Framework\Model\AbstractModel
{

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var string
     */
    protected $_eventPrefix = 'coolc_productsubscription_subscription';
    /**
     * @var SubscriptionInterfaceFactory
     */
    protected $subscriptionDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param SubscriptionInterfaceFactory $subscriptionDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \CoolC\ProductSubscription\Model\ResourceModel\Subscription $resource
     * @param \CoolC\ProductSubscription\Model\ResourceModel\Subscription\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        SubscriptionInterfaceFactory $subscriptionDataFactory,
        DataObjectHelper $dataObjectHelper,
        \CoolC\ProductSubscription\Model\ResourceModel\Subscription $resource,
        \CoolC\ProductSubscription\Model\ResourceModel\Subscription\Collection $resourceCollection,
        array $data = []
    ) {
        $this->subscriptionDataFactory = $subscriptionDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve subscription model with subscription data
     * @return SubscriptionInterface
     */
    public function getDataModel()
    {
        $subscriptionData = $this->getData();

        $subscriptionDataObject = $this->subscriptionDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $subscriptionDataObject,
            $subscriptionData,
            SubscriptionInterface::class
        );

        return $subscriptionDataObject;
    }
}

