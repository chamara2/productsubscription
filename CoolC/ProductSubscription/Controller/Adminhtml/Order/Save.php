<?php

namespace CoolC\ProductSubscription\Controller\Adminhtml\Order;

/**
 * Class Save
 * @package CoolC\ProductSubscription\Controller\Adminhtml\Order
 */
class Save extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Sales\Model\Order $orderRepository,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_orderRepository = $orderRepository;
        $this->_messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();

        $_order = $this->_orderRepository->load($data['order_id']); // it order is not order increment id
        if($_order->getId()){
            $_order->setDiscountOrder($data['discount_order']);
            $_order->setDiscountAmount($data['discount_order']);
            $_order->setGrandTotal($_order->getGrandTotal() - $data['discount_order']);
            $_order->save();
        }
        $this->_messageManager->addSuccess(__("Successfully updated"));
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('sales/order/view/order_id/'.$data['order_id']);
        return $resultRedirect;
    }
}

