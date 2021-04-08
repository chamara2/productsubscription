<?php

namespace CoolC\ProductSubscription\Api\Data;

/**
 * Interface SubscriptionSearchResultsInterface
 * @package CoolC\ProductSubscription\Api\Data
 */
interface SubscriptionSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get subscription list.
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface[]
     */
    public function getItems();

    /**
     * Set title list.
     * @param \CoolC\ProductSubscription\Api\Data\SubscriptionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

