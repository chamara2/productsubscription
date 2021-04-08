<?php

namespace CoolC\ProductSubscription\Controller\Adminhtml\Subscription;

/**
 * Class Delete
 * @package CoolC\ProductSubscription\Controller\Adminhtml\Subscription
 */
class Delete extends \CoolC\ProductSubscription\Controller\Adminhtml\Subscription
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('subscription_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\CoolC\ProductSubscription\Model\Subscription::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Subscription.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['subscription_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Subscription to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

