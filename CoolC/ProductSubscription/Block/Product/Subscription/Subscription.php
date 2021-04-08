<?php

namespace CoolC\ProductSubscription\Block\Product\Subscription;

/**
 * Class CustomPrice
 * @package CoolC\ProductSubscription\Block\Product\Price
 */
class Subscription extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \CoolC\ProductSubscription\Model\SubscriptionFactory
     */
    protected $_subscriptionFactory;
    /**
     * @var \Magento\Customer\Model\Session
     */
    private $_customerSession;
    protected $_registry;

    /**
     * Subscription constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \CoolC\ProductSubscription\Model\SubscriptionFactory $subscriptionFactory
     * @param \Magento\Customer\Model\Session $customerSession
     */
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
                                \CoolC\ProductSubscription\Model\SubscriptionFactory $subscriptionFactory,
                                \Magento\Customer\Model\Session $customerSession,
                                \Magento\Framework\Registry $registry
    )
    {
        $this->_subscriptionFactory = $subscriptionFactory;
        $this->_customerSession = $customerSession;
        $this->_registry = $registry;
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isCustomerLoggedIn(){
        return $this->_customerSession->isLoggedIn();
    }

    /**
     * @param $sku
     * @return array
     */
    public function getLoadSubscription()
    {
        $getCurrentProduct = $this->getCurrentProduct();
        $subscription = $getCurrentProduct->getSubscription();
        if($subscription) {
            $post = $this->_subscriptionFactory->create();
            $collection = $post->getCollection();

            return $collection;
        }else{
            return false;
        }
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }
}
