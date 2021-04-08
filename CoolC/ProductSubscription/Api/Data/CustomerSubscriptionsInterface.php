<?php

namespace CoolC\ProductSubscription\Api\Data;

interface CustomerSubscriptionsInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const CUSTOMER_SUBSCRIPTIONS_ID = 'customer_subscriptions_id';
    const CUSTOMER_ID = 'customer_id';
    const PRODUCT_ID = 'product_id';
    const DURATION = 'duration';

    /**
     * Get customer_subscriptions_id
     * @return string|null
     */
    public function getCustomerSubscriptionsId();

    /**
     * Set customer_subscriptions_id
     * @param string $customerSubscriptionsId
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface
     */
    public function setCustomerSubscriptionsId($customerSubscriptionsId);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface
     */
    public function setCustomerId($customerId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsExtensionInterface $extensionAttributes
    );

    /**
     * Get product_id
     * @return string|null
     */
    public function getProductId();

    /**
     * Set product_id
     * @param string $productId
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface
     */
    public function setProductId($productId);

    /**
     * Get duration
     * @return string|null
     */
    public function getDuration();

    /**
     * Set duration
     * @param string $duration
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface
     */
    public function setDuration($duration);
}

