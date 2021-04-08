<?php

namespace CoolC\ProductSubscription\Model\ResourceModel\Subscription;

/**
 * Class Collection
 * @package CoolC\ProductSubscription\Model\ResourceModel\Subscription
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'subscription_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \CoolC\ProductSubscription\Model\Subscription::class,
            \CoolC\ProductSubscription\Model\ResourceModel\Subscription::class
        );
    }
}

