<?php

namespace CoolC\ProductSubscription\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CustomerSubscriptionsRepositoryInterface
{

    /**
     * Save customer_subscriptions
     * @param \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface $customerSubscriptions
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface $customerSubscriptions
    );

    /**
     * Retrieve customer_subscriptions
     * @param string $customerSubscriptionsId
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($customerSubscriptionsId);

    /**
     * Retrieve customer_subscriptions matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete customer_subscriptions
     * @param \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface $customerSubscriptions
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface $customerSubscriptions
    );

    /**
     * Delete customer_subscriptions by ID
     * @param string $customerSubscriptionsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($customerSubscriptionsId);
}

