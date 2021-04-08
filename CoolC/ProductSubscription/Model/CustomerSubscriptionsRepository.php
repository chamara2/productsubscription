<?php

namespace CoolC\ProductSubscription\Model;

use CoolC\ProductSubscription\Api\CustomerSubscriptionsRepositoryInterface;
use CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterfaceFactory;
use CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsSearchResultsInterfaceFactory;
use CoolC\ProductSubscription\Model\ResourceModel\CustomerSubscriptions as ResourceCustomerSubscriptions;
use CoolC\ProductSubscription\Model\ResourceModel\CustomerSubscriptions\CollectionFactory as CustomerSubscriptionsCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class CustomerSubscriptionsRepository implements CustomerSubscriptionsRepositoryInterface
{

    protected $searchResultsFactory;

    protected $customerSubscriptionsFactory;

    private $storeManager;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $dataObjectHelper;

    protected $customerSubscriptionsCollectionFactory;

    protected $extensibleDataObjectConverter;
    protected $resource;

    protected $dataCustomerSubscriptionsFactory;


    /**
     * @param ResourceCustomerSubscriptions $resource
     * @param CustomerSubscriptionsFactory $customerSubscriptionsFactory
     * @param CustomerSubscriptionsInterfaceFactory $dataCustomerSubscriptionsFactory
     * @param CustomerSubscriptionsCollectionFactory $customerSubscriptionsCollectionFactory
     * @param CustomerSubscriptionsSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceCustomerSubscriptions $resource,
        CustomerSubscriptionsFactory $customerSubscriptionsFactory,
        CustomerSubscriptionsInterfaceFactory $dataCustomerSubscriptionsFactory,
        CustomerSubscriptionsCollectionFactory $customerSubscriptionsCollectionFactory,
        CustomerSubscriptionsSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->customerSubscriptionsFactory = $customerSubscriptionsFactory;
        $this->customerSubscriptionsCollectionFactory = $customerSubscriptionsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomerSubscriptionsFactory = $dataCustomerSubscriptionsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface $customerSubscriptions
    ) {
        /* if (empty($customerSubscriptions->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $customerSubscriptions->setStoreId($storeId);
        } */

        $customerSubscriptionsData = $this->extensibleDataObjectConverter->toNestedArray(
            $customerSubscriptions,
            [],
            \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface::class
        );

        $customerSubscriptionsModel = $this->customerSubscriptionsFactory->create()->setData($customerSubscriptionsData);

        try {
            $this->resource->save($customerSubscriptionsModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customerSubscriptions: %1',
                $exception->getMessage()
            ));
        }
        return $customerSubscriptionsModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($customerSubscriptionsId)
    {
        $customerSubscriptions = $this->customerSubscriptionsFactory->create();
        $this->resource->load($customerSubscriptions, $customerSubscriptionsId);
        if (!$customerSubscriptions->getId()) {
            throw new NoSuchEntityException(__('customer_subscriptions with id "%1" does not exist.', $customerSubscriptionsId));
        }
        return $customerSubscriptions->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->customerSubscriptionsCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \CoolC\ProductSubscription\Api\Data\CustomerSubscriptionsInterface $customerSubscriptions
    ) {
        try {
            $customerSubscriptionsModel = $this->customerSubscriptionsFactory->create();
            $this->resource->load($customerSubscriptionsModel, $customerSubscriptions->getCustomerSubscriptionsId());
            $this->resource->delete($customerSubscriptionsModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the customer_subscriptions: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($customerSubscriptionsId)
    {
        return $this->delete($this->get($customerSubscriptionsId));
    }
}

