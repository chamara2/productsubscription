<?php

namespace CoolC\ProductSubscription\Model\ResourceModel\CustomerSubscriptions;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'customer_subscriptions_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \CoolC\ProductSubscription\Model\CustomerSubscriptions::class,
            \CoolC\ProductSubscription\Model\ResourceModel\CustomerSubscriptions::class
        );
    }
}

