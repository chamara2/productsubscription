<?php

namespace CoolC\ProductSubscription\Api\Data;

/**
 * Interface SubscriptionInterface
 * @package CoolC\ProductSubscription\Api\Data
 */
interface SubscriptionInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    /**
     *
     */
    const SUBSCRIPTION_ID = 'subscription_id';
    /**
     *
     */
    const UPDATED = 'updated';
    /**
     *
     */
    const CREATED = 'created';
    /**
     *
     */
    const DURATION = 'duration';
    /**
     *
     */
    const TITLE = 'title';

    /**
     * Get subscription_id
     * @return string|null
     */
    public function getSubscriptionId();

    /**
     * Set subscription_id
     * @param string $subscriptionId
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     */
    public function setSubscriptionId($subscriptionId);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     */
    public function setTitle($title);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \CoolC\ProductSubscription\Api\Data\SubscriptionExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \CoolC\ProductSubscription\Api\Data\SubscriptionExtensionInterface $extensionAttributes
    );

    /**
     * Get duration
     * @return string|null
     */
    public function getDuration();

    /**
     * Set duration
     * @param string $duration
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     */
    public function setDuration($duration);


    /**
     * Get created
     * @return string|null
     */
    public function getCreated();

    /**
     * Set created
     * @param string $created
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     */
    public function setCreated($created);

    /**
     * Get updated
     * @return string|null
     */
    public function getUpdated();

    /**
     * Set updated
     * @param string $updated
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     */
    public function setUpdated($updated);
}

