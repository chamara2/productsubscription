<?php

namespace CoolC\ProductSubscription\Model\Data;

use CoolC\ProductSubscription\Api\Data\SubscriptionInterface;

/**
 * Class Subscription
 * @package CoolC\ProductSubscription\Model\Data
 */
class Subscription extends \Magento\Framework\Api\AbstractExtensibleObject implements SubscriptionInterface
{

    /**
     * Get subscription_id
     * @return string|null
     */
    public function getSubscriptionId()
    {
        return $this->_get(self::SUBSCRIPTION_ID);
    }

    /**
     * Set subscription_id
     * @param string $subscriptionId
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     */
    public function setSubscriptionId($subscriptionId)
    {
        return $this->setData(self::SUBSCRIPTION_ID, $subscriptionId);
    }

    /**
     * Get title
     * @return string|null
     */
    public function getTitle()
    {
        return $this->_get(self::TITLE);
    }

    /**
     * Set title
     * @param string $title
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \CoolC\ProductSubscription\Api\Data\SubscriptionExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \CoolC\ProductSubscription\Api\Data\SubscriptionExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
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
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     */
    public function setDuration($duration)
    {
        return $this->setData(self::DURATION, $duration);
    }

    /**
     * Get active
     * @return string|null
     */
    public function getActive()
    {
        return $this->_get(self::ACTIVE);
    }

    /**
     * Set active
     * @param string $active
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     */
    public function setActive($active)
    {
        return $this->setData(self::ACTIVE, $active);
    }

    /**
     * Get created
     * @return string|null
     */
    public function getCreated()
    {
        return $this->_get(self::CREATED);
    }

    /**
     * Set created
     * @param string $created
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     */
    public function setCreated($created)
    {
        return $this->setData(self::CREATED, $created);
    }

    /**
     * Get updated
     * @return string|null
     */
    public function getUpdated()
    {
        return $this->_get(self::UPDATED);
    }

    /**
     * Set updated
     * @param string $updated
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     */
    public function setUpdated($updated)
    {
        return $this->setData(self::UPDATED, $updated);
    }
}

