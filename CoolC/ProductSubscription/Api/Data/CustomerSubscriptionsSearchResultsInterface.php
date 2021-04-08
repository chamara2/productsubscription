<?php

namespace CoolC\ProductSubscription\Api\Data;

interface CustomerSubscriptionsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get customer_subscriptions list.
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface[]
     */
    public function getItems();

    /**
     * Set customer_id list.
     * @param \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

