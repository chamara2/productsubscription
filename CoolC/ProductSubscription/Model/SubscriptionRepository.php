<?php

namespace CoolC\ProductSubscription\Model;

use CoolC\ProductSubscription\Api\Data\SubscriptionInterfaceFactory;
use CoolC\ProductSubscription\Api\Data\SubscriptionSearchResultsInterfaceFactory;
use CoolC\ProductSubscription\Api\SubscriptionRepositoryInterface;
use CoolC\ProductSubscription\Model\ResourceModel\Subscription as ResourceSubscription;
use CoolC\ProductSubscription\Model\ResourceModel\Subscription\CollectionFactory as SubscriptionCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class SubscriptionRepository
 * @package CoolC\ProductSubscription\Model
 */
class SubscriptionRepository implements SubscriptionRepositoryInterface
{

    /**
     * @var SubscriptionSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var SubscriptionCollectionFactory
     */
    protected $subscriptionCollectionFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var JoinProcessorInterface
     */
    protected $extensionAttributesJoinProcessor;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var SubscriptionInterfaceFactory
     */
    protected $dataSubscriptionFactory;

    /**
     * @var ExtensibleDataObjectConverter
     */
    protected $extensibleDataObjectConverter;
    /**
     * @var ResourceSubscription
     */
    protected $resource;

    /**
     * @var SubscriptionFactory
     */
    protected $subscriptionFactory;


    /**
     * @param ResourceSubscription $resource
     * @param SubscriptionFactory $subscriptionFactory
     * @param SubscriptionInterfaceFactory $dataSubscriptionFactory
     * @param SubscriptionCollectionFactory $subscriptionCollectionFactory
     * @param SubscriptionSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceSubscription $resource,
        SubscriptionFactory $subscriptionFactory,
        SubscriptionInterfaceFactory $dataSubscriptionFactory,
        SubscriptionCollectionFactory $subscriptionCollectionFactory,
        SubscriptionSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->subscriptionFactory = $subscriptionFactory;
        $this->subscriptionCollectionFactory = $subscriptionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataSubscriptionFactory = $dataSubscriptionFactory;
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
        \CoolC\ProductSubscription\Api\Data\SubscriptionInterface $subscription
    ) {
        /* if (empty($subscription->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $subscription->setStoreId($storeId);
        } */

        $subscriptionData = $this->extensibleDataObjectConverter->toNestedArray(
            $subscription,
            [],
            \CoolC\ProductSubscription\Api\Data\SubscriptionInterface::class
        );

        $subscriptionModel = $this->subscriptionFactory->create()->setData($subscriptionData);

        try {
            $this->resource->save($subscriptionModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the subscription: %1',
                $exception->getMessage()
            ));
        }
        return $subscriptionModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($subscriptionId)
    {
        $subscription = $this->subscriptionFactory->create();
        $this->resource->load($subscription, $subscriptionId);
        if (!$subscription->getId()) {
            throw new NoSuchEntityException(__('subscription with id "%1" does not exist.', $subscriptionId));
        }
        return $subscription->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->subscriptionCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \CoolC\ProductSubscription\Api\Data\SubscriptionInterface::class
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
        \CoolC\ProductSubscription\Api\Data\SubscriptionInterface $subscription
    ) {
        try {
            $subscriptionModel = $this->subscriptionFactory->create();
            $this->resource->load($subscriptionModel, $subscription->getSubscriptionId());
            $this->resource->delete($subscriptionModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the subscription: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($subscriptionId)
    {
        return $this->delete($this->get($subscriptionId));
    }
}

