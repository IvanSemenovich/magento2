<?php

namespace Overdose\Reviews\ViewModel;

use Magento\Catalog\Model\SessionFactory;
use Magento\Customer\Model\SessionFactory as Customer;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Overdose\Reviews\Model\ResourceModel\Review\CollectionFactory;

class Reviews implements ArgumentInterface
{
    protected $reviewsCollectionFactory;
    protected $sessionsFactory;
    protected $customerSessionFactory;
    public function __construct(
        CollectionFactory $reviewsCollectionFactory,
        SessionFactory $sessionFactory,
        Customer $customerSessionFactory
    ) {
        $this->reviewsCollectionFactory = $reviewsCollectionFactory;
        $this->sessionsFactory = $sessionFactory;
        $this->customerSessionFactory = $customerSessionFactory;
    }

    public function getProductReviewById()
    {
        /**
         * @var $collection
         */
        $productId = $this->sessionsFactory->create()->getData('last_viewed_product_id');
        $collection = $this->reviewsCollectionFactory->create();
        $collection->addFieldToFilter("product_id", ["eq" => $productId]);
        return $collection;
    }

    public function getCustomerId()
    {
        $customerSession = $this->customerSessionFactory->create();
        return  $customerSession->getCustomerId();
    }
    public function getReviewsByCustomerId()
    {
        $collection = $this->reviewsCollectionFactory->create();
        $collection->addFieldToFilter("customer_id", ["eq" => $this->getCustomerId()]);
        return $collection;
    }

    public function getAvarageProductRating()
    {
        $collection = $this->reviewsCollectionFactory->create();
        $ratingPercent  =    $collection->addFieldToSelect("rating")->getItems();


        return $collection;
    }
}
