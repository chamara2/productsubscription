<?php

namespace CoolC\ProductSubscription\Controller\Product;

use CoolC\ProductSubscription\Model\SubscriptionFactory;
use Magento\Catalog\Model\ProductFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;

class Subscriptions extends \Magento\Framework\App\Action\Action {

    protected $resultJsonFactory;
    /**
     * @var SubscriptionFactory
     */
    protected $_subscriptionFactory;
    /**
     * @var Session
     */
    private $_customerSession;
    protected $_productloader;
    protected $request;

    public function __construct(
        Context  $context,
        JsonFactory $resultJsonFactory,
        SubscriptionFactory $subscriptionFactory,
        Session $customerSession,
        ProductFactory $productloader,
        Http $request
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_subscriptionFactory = $subscriptionFactory;
        $this->_customerSession = $customerSession;
        $this->_productloader = $productloader;
        $this->request = $request;

        parent::__construct($context);
    }


    public function execute()
    {
        $options = '';
        if ($this->isCustomerLoggedIn()) {
            $getLoadSubscriptionModel = $this->getLoadSubscription();
            if ($getLoadSubscriptionModel) {
                $getLoadSubscription = $getLoadSubscriptionModel->getData();
                foreach ($getLoadSubscription as $item) {
                    $options .= "<option value=" . $item['duration'] . ">" . $item['title'] . "</option>";
                }
            }

            echo '
<p><input name="subscription" required="required" type="radio" value="0"/><br />
    One time</p>
<p><input checked="checked" name="subscription" required="required" type="radio" value="1"/></p>
<p>Subscription</p>
<div class="duration">Duration&nbsp;<select name="duration" class="select-duration" required="required">
        <option selected="selected" value="">Select</option>'.$options.'
    </select></div>
        ';

        }
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
        return $this->_productloader->create()->load($this->request->getParam('product_id'));
    }
}
