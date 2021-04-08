<?php

namespace CoolC\ProductSubscription\Controller\Adminhtml\Subscription;

/**
 * Class Edit
 * @package CoolC\ProductSubscription\Controller\Adminhtml\Subscription
 */
class Edit extends \CoolC\ProductSubscription\Controller\Adminhtml\Subscription
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('subscription_id');
        $model = $this->_objectManager->create(\CoolC\ProductSubscription\Model\Subscription::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Subscription no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('coolc_productsubscription_subscription', $model);

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Subscription') : __('New Duration'),
            $id ? __('Edit Subscription') : __('New Duration')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Duration'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Duration %1', $model->getId()) : __('New Duration'));
        return $resultPage;
    }
}

