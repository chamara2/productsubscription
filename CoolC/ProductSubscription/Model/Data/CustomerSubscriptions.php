<?php

namespace CoolC\ProductSubscription\Model\Data;

use CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface;

class CustomerSubscriptions extends \Magento\Framework\Api\AbstractExtensibleObject implements CustomerSubscriptionsInterface
{

    /**
     * Get customer_subscriptions_id
     * @return string|null
     */
    public function getCustomerSubscriptionsId()
    {
        return $this->_get(self::CUSTOMER_SUBSCRIPTIONS_ID);
    }

    /**
     * Set customer_subscriptions_id
     * @param string $customerSubscriptionsId
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface
     */
    public function setCustomerSubscriptionsId($customerSubscriptionsId)
    {
        return $this->setData(self::CUSTOMER_SUBSCRIPTIONS_ID, $customerSubscriptionsId);
    }

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_get(self::CUSTOMER_ID);
    }

    /**
     * Set customer_id
     * @param string $customerId
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get product_id
     * @return string|null
     */
    public function getProductId()
    {
        return $this->_get(self::PRODUCT_ID);
    }

    /**
     * Set product_id
     * @param string $productId
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Get duration
     * @return string|null
     */
    public function getDuration()
    {
        return $this->_get(self::DURATION);
    }

    /**
     * Set duration
     * @param string $duration
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface
     */
    public function setDuration($duration)
    {
        return $this->setData(self::DURATION, $duration);
    }
}

