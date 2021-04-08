<?php

namespace CoolC\ProductSubscription\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface SubscriptionRepositoryInterface
 * @package CoolC\ProductSubscription\Api
 */
interface SubscriptionRepositoryInterface
{

    /**
     * Save subscription
     * @param \CoolC\ProductSubscription\Api\Data\SubscriptionInterface $subscription
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \CoolC\ProductSubscription\Api\Data\SubscriptionInterface $subscription
    );

    /**
     * Retrieve subscription
     * @param string $subscriptionId
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($subscriptionId);

    /**
     * Retrieve subscription matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \CoolC\ProductSubscription\Api\Data\SubscriptionSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete subscription
     * @param \CoolC\ProductSubscription\Api\Data\SubscriptionInterface $subscription
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \CoolC\ProductSubscription\Api\Data\SubscriptionInterface $subscription
    );

    /**
     * Delete subscription by ID
     * @param string $subscriptionId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($subscriptionId);
}

