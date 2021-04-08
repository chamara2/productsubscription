<?php

namespace CoolC\ProductSubscription\Model\ResourceModel;

/**
 * Class Subscription
 * @package CoolC\ProductSubscription\Model\ResourceModel
 */
class Subscription extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('coolc_productsubscription_subscription', 'subscription_id');
    }
}

