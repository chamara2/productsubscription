<?php

namespace CoolC\ProductSubscription\Observer\Frontend;

use CoolC\ProductSubscription\Model\CustomerSubscriptionsFactory;
use CoolC\ProductSubscription\Model\CustomerSubscriptionsRepository;
use Magento\Checkout\Model\Cart;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Message\ManagerInterface;
use Magento\Quote\Model\QuoteRepository;

/**
 * Class ActionCheckoutCartAddComplete
 *
 * @package CoolC\ProductSubscription\Observer\Frontend\Controller
 */
class ActionCheckoutCartAddComplete implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var Session
     */
    protected $_checkoutSession;
    /**
     * @var QuoteRepository
     */
    protected $_quoteRepository;

    /**
     * @var CustomerSubscriptionsFactory
     */
    protected $_customerSubscriptionFactory;

    /**
     * @var RequestInterface
     */
    protected $_request;

    /**
     * @var ManagerInterface
     */
    protected $_messageManager;
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;
    /**
     * @var CustomerSubscriptionsRepository
     */
    protected $_customerSubscriptionsRepository;
    /**
     * @var Cart
     */
    protected $_cart;

    /**
     * ActionCheckoutCartAddComplete constructor.
     * @param Session $checkoutSession
     * @param QuoteRepository $quoteRepository
     * @param CustomerSubscriptionsFactory $customerSubscriptionsFactory
     * @param RequestInterface $request
     * @param ManagerInterface $messageManager
     * @param \Magento\Customer\Model\Session $customerSession
     * @param CustomerSubscriptionsRepository $customerSubscriptionsRepository
     * @param Cart $cart
     */
    public function __construct(
        Session $checkoutSession,
        QuoteRepository $quoteRepository,
        CustomerSubscriptionsFactory $customerSubscriptionsFactory,
        RequestInterface $request,
        ManagerInterface $messageManager,
        \Magento\Customer\Model\Session $customerSession,
        CustomerSubscriptionsRepository $customerSubscriptionsRepository,
        Cart $cart
    ) {
        $this->_checkoutSession = $checkoutSession;
        $this->_quoteRepository = $quoteRepository;
        $this->_customerSubscriptionFactory = $customerSubscriptionsFactory;
        $this->_request = $request;
        $this->_messageManager = $messageManager;
        $this->_customerSession = $customerSession;
        $this->_customerSubscriptionsRepository = $customerSubscriptionsRepository;
        $this->_cart = $cart;
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        $product = $observer->getEvent()->getDataByKey('product');
        //$item = $this->_checkoutSession->getQuote()->getItemByProduct($product);
        $postData = $this->_request->getPost();

        if($this->_customerSession->getCustomer()->getId()) {
            $subscription = $product->getSubscription();
            if ($subscription) {
                $data['product_id'] = $product->getId();
                $data['duration'] = $postData['duration'];
                $data['customer_id'] = $this->_customerSession->getCustomer()->getId();

                try {
                    $model = $this->_customerSubscriptionFactory->create();
                    $model->setData($data)->save();
                } catch (LocalizedException $e) {
                    $this->_messageManager->addErrorMessage($e->getMessage());
                } catch (\Exception $e) {
                    $this->_messageManager->addExceptionMessage($e, __('Something went wrong while saving the Subscription.'));
                }

                //$quoteData = $this->_checkoutSession->getQuote()->getData();
                $quoteId =  $this->_checkoutSession->getQuote()->getEntityId();

               /* $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/calculateCustomPrice.log');
                $logger = new \Zend\Log\Logger();
                $logger->addWriter($writer);
                $logger->info($quoteId);*/

                //if($quoteId) {
                    $quote = $this->_quoteRepository->get($quoteId); // Get quote by id

                    $quote->setData('subscription', $postData['subscription']); // Fill data
                    $quote->setData('duration', $data['duration']); // Fill data
                    $this->_quoteRepository->save($quote); // Save quote
                //}
            }
        }
    }
}
