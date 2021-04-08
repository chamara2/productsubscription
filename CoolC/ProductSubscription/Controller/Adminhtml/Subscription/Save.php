<?php

namespace CoolC\ProductSubscription\Controller\Adminhtml\Subscription;

use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 * @package CoolC\ProductSubscription\Controller\Adminhtml\Subscription
 */
class Save extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('subscription_id');
            $data['created'] = date("Y-m-d h:i:s");
            $data['updated'] = date("Y-m-d h:i:s");
            $model = $this->_objectManager->create(\CoolC\ProductSubscription\Model\Subscription::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Subscription no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
            if($id){
                $data['updated'] = date("Y-m-d H:s:i");
            }
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Subscription.'));
                $this->dataPersistor->clear('coolc_productsubscription_subscription');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['subscription_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Subscription.'));
            }

            $this->dataPersistor->set('coolc_productsubscription_subscription', $data);
            return $resultRedirect->setPath('*/*/edit', ['subscription_id' => $this->getRequest()->getParam('subscription_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

