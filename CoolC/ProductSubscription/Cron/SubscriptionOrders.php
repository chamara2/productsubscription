<?php

namespace CoolC\ProductSubscription\Cron;

use Magento\Framework\App\Action\Context;
use Magento\Quote\Api\CartManagementInterface;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\QuoteFactory;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

class SubscriptionOrders
{

    protected $_logger;
    protected $_quoteManagement;
    protected $_orderCollectionFactory;
    protected $_quoteRepository;

    /**
     * Constructor
     *
     * @param Context $context
     * @param \Psr\Log\LoggerInterface $logger
     * @param CartManagementInterface $quoteManagement
     */
    public function __construct(\Psr\Log\LoggerInterface $logger,
                                CartManagementInterface $quoteManagement,
                                CollectionFactory $orderCollectionFactory,
                                CartRepositoryInterface $quoteRepository
    )
    {
        $this->_logger = $logger;
        $this->_quoteManagement = $quoteManagement;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_quoteRepository = $quoteRepository;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute()
    {
        $orders = $this->_orderCollectionFactory->create()
            ->addFieldToFilter('subscription', 1);
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/cronrun.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info($orders->getSelect());

        foreach ($orders as $order) {
            // $old_date = get old order date
            // $today = get tommorow
            // $today = get tommorow
            // if (old_date+order_duration) == tommorow / create subscription order
            $quote = $this->_quoteRepository->get($order->getQuoteId());
            $logger->info($quote->getData());
            $order = $this->_quoteManagement->submit($quote);
            //need more improvement here, for check the date duration and create orders according to that.commented above
        }
        //$this->_logger->addInfo($orders->getSelect());
    }
}
