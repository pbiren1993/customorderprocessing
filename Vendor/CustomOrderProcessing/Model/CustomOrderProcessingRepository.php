<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vendor\CustomOrderProcessing\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vendor\CustomOrderProcessing\Api\CustomOrderProcessingRepositoryInterface;
use Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterface;
use Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingInterfaceFactory;
use Vendor\CustomOrderProcessing\Api\Data\CustomOrderProcessingSearchResultsInterfaceFactory;
use Vendor\CustomOrderProcessing\Model\ResourceModel\CustomOrderProcessing as ResourceCustomOrderProcessing;
use Vendor\CustomOrderProcessing\Model\ResourceModel\CustomOrderProcessing\CollectionFactory;

class CustomOrderProcessingRepository implements CustomOrderProcessingRepositoryInterface
{

    /**
     * @var CustomOrderProcessing
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var ResourceCustomOrderProcessing
     */
    protected $resource;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var CustomOrderProcessingInterfaceFactory
     */
    protected $customOrderProcessingFactory;

    /**
     * @param ResourceCustomOrderProcessing $resource
     * @param CustomOrderProcessingInterfaceFactory $customOrderProcessingFactory
     * @param CollectionFactory $collectionFactory
     * @param CustomOrderProcessingSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceCustomOrderProcessing $resource,
        CustomOrderProcessingInterfaceFactory $customOrderProcessingFactory,
        CollectionFactory $collectionFactory,
        CustomOrderProcessingSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->customOrderProcessingFactory = $customOrderProcessingFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(
        CustomOrderProcessingInterface $customOrderProcessing
    ) {
        try {
            $this->resource->save($customOrderProcessing);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customOrderProcessing: %1',
                $exception->getMessage()
            ));
        }
        return $customOrderProcessing;
    }

    /**
     * @inheritDoc
     */
    public function get($customOrderProcessingId)
    {
        $customOrderProcessing = $this->customOrderProcessingFactory->create();
        $this->resource->load($customOrderProcessing, $customOrderProcessingId);
        if (!$customOrderProcessing->getId()) {
            throw new NoSuchEntityException(__('process with id "%1" does not exist.', $customOrderProcessingId));
        }
        return $customOrderProcessing;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->collectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(
        CustomOrderProcessingInterface $customOrderProcessing
    ) {
        try {
            $customOrderProcessingModel = $this->customOrderProcessingFactory->create();
            $this->resource->load($customOrderProcessingModel, $customOrderProcessing->getCustomorderprocessingId());
            $this->resource->delete($customOrderProcessingModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the customOrderProcessing: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($customOrderProcessingId)
    {
        return $this->delete($this->get($customOrderProcessingId));
    }
}
