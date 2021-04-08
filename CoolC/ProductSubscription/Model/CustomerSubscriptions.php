<?php

namespace CoolC\ProductSubscription\Model;

use CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface;
use CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class CustomerSubscriptions extends \Magento\Framework\Model\AbstractModel
{

    protected $customer_subscriptionsDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'coolc_productsubscription_customer_subscriptions';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param CustomerSubscriptionsInterfaceFactory $customer_subscriptionsDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \CoolC\ProductSubscription\Model\ResourceModel\CustomerSubscriptions $resource
     * @param \CoolC\ProductSubscription\Model\ResourceModel\CustomerSubscriptions\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        CustomerSubscriptionsInterfaceFactory $customer_subscriptionsDataFactory,
        DataObjectHelper $dataObjectHelper,
        \CoolC\ProductSubscription\Model\ResourceModel\CustomerSubscriptions $resource,
        \CoolC\ProductSubscription\Model\ResourceModel\CustomerSubscriptions\Collection $resourceCollection,
        array $data = []
    ) {
        $this->customer_subscriptionsDataFactory = $customer_subscriptionsDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve customer_subscriptions model with customer_subscriptions data
     * @return CustomerSubscriptionsInterface
     */
    public function getDataModel()
    {
        $customer_subscriptionsData = $this->getData();

        $customer_subscriptionsDataObject = $this->customer_subscriptionsDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $customer_subscriptionsDataObject,
            $customer_subscriptionsData,
            CustomerSubscriptionsInterface::class
        );

        return $customer_subscriptionsDataObject;
    }
}

