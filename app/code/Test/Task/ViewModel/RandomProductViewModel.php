<?php

namespace Test\Task\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Element\Context;
use Test\Task\Helper\Data;
use \Magento\Checkout\Helper\Cart as CartHelper;
use \Magento\Catalog\Api\ProductRepositoryInterface;

class RandomProductViewModel implements ArgumentInterface
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var ProductCollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var CartHelper
     */
    protected $cartHelper;
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @param Data $helper
     * @param ProductCollectionFactory $productCollectionFactory
     * @param CartHelper $cartHelper
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        Data                     $helper,
        ProductCollectionFactory $productCollectionFactory,
        CartHelper $cartHelper,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->cartHelper = $cartHelper;
        $this->productRepository = $productRepository;

        $this->helper = $helper;
        $this->productCollectionFactory = $productCollectionFactory;
    }


    public function getBlockTitle()
    {
        return $this->helper->getTitle();
    }

    /**
     * @return ProductInterface
     */
    public function getRandomProduct(): ProductInterface
    {
        $productCollection = $this->productCollectionFactory->create();

        $productCollection->getSelect()->orderRand();

        return $productCollection->getFirstItem();

    }
    public function getAddToCartUrl($productSku)
    {
        $product = $this->productRepository->get($productSku);
        return $this->cartHelper->getAddUrl($product);
    }


}
