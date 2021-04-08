<?php

namespace CoolC\ProductSubscription\Model\ResourceModel;

class CustomerSubscriptions extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('coolc_productsubscription_customer_subscriptions', 'customer_subscriptions_id');
    }
}

