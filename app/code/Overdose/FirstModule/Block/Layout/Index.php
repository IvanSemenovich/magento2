<?php
declare(strict_types=1);

namespace Overdose\FirstModule\Block\Layout;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Template;

class Index extends Template
{
    protected $categoryRepository;
    protected $searchCriteriaBuilder;
    protected $productRepository;
    protected $collectionFactory;

    public function __construct(
        Template\Context            $context,
        CategoryRepositoryInterface $categoryRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ProductRepositoryInterface $productRepository,
        CollectionFactory $collectionFactory,
        array
        $data = []
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->productRepository = $productRepository;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getPisya(): ?string
    {
        return $this->categoryRepository->get(2)->getName();
    }

    /**
     * @return ProductInterface[]
     */
    public function getAllProductList(): array
    {
        return $this->productRepository->getList(
            $this->searchCriteriaBuilder->addFilter("category_id", [3], "in")->create()
        )->getItems();
    }

    /**
     * @param $price
     * @return DataObject[]
     */
    public function getCheapProducts($price)
    {
        $productCollection = $this->collectionFactory->create();
        $productCollection->addAttributeToSelect("*")->addAttributeToFilter(ProductInterface::PRICE, ["lt" =>$price])->load();
        return $productCollection->getItems();
    }
}

