<?php
namespace CoolC\ProductSubscription\Observer\Frontend;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;
use \Magento\Sales\Model\OrderFactory;
use \Magento\Quote\Model\QuoteFactory;

/**
 * Class SaveToOder
 * @package CoolC\ProductSubscription\Observer\Frontend
 */
class SaveToOder implements ObserverInterface
{
    protected $orderFactory;
    protected $quoteFactory;
    protected $_orderRepository;

    /**
     * @param OrderFactory $orderFactory
     * @param QuoteFactory $quoteFactory
     * @param Order $orderRepository
     */
    public function __construct(
        OrderFactory $orderFactory,
        QuoteFactory $quoteFactory,
        Order $orderRepository
    ) {
        $this->orderFactory = $orderFactory;
        $this->quoteFactory = $quoteFactory;
        $this->_orderRepository = $orderRepository;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $this->quoteFactory->create()->load($order->getQuoteId());

        /*$incrementId = $order->getIncrementId();
        $writer = new \Zend\Log\Writer\Stream( BP . '/var/log/'.$incrementId.'.log' );
        $logger = new \Zend\Log\Logger();
        $logger->addWriter ( $writer );
        $logger->info( $order->getData() );*/

        $_order = $this->_orderRepository->load($order->getId()); // it order is not order increment id

        if(!empty($_order)) {
            if ($_order->getId()) {
                $_order->setSubscription($quote->getSubscription());
                $_order->setDuration($quote->getDuration());
                $_order->save();

                // improvement need to import customer subscription factory and
            }
        }
    }
}
