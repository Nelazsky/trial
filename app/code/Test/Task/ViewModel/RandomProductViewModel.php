<?php

namespace Test\Task\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface as Product;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Test\Task\Helper\Data;
use Magento\Catalog\Block\Product\Image;

class RandomProductViewModel implements ArgumentInterface
{
    /**
     * @var Product
     */
    private $randomProduct;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var ProductCollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var ListProduct
     */
    protected $listProduct;

    /**
     * @param Data $helper
     * @param ProductCollectionFactory $productCollectionFactory
     * @param ListProduct $listProduct
     */
    public function __construct(
        Data                     $helper,
        ProductCollectionFactory $productCollectionFactory,
        ListProduct              $listProduct

    )
    {
        $this->listProduct = $listProduct;
        $this->helper = $helper;
        $this->productCollectionFactory = $productCollectionFactory;
    }

    /**
     * @return string
     */
    public function getBlockTitle(): string
    {
        return $this->helper->getTitle();
    }

    /**
     * @return Product
     */
    private function getRandomProduct(): Product
    {
        if ($this->randomProduct === null) {
            $productCollection = $this->productCollectionFactory->create();

            $productCollection
                ->addAttributeToSelect('name')
                ->addAttributeToSelect('price')
                ->getSelect()
                ->where('type_id = ?', 'simple')
                ->orderRand()
                ->limit(1);
            $this->randomProduct = $productCollection->getFirstItem();
        }

        return $this->randomProduct;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
         return $this->getRandomProduct()->getName();
    }

    /**
     * @return string
     */
    public function getProductPrice(): string
    {
        return $this->listProduct->getProductPrice($this->getRandomProduct());
    }

    /**
     * @return Image
     */
    public function getProductImage(): Image
    {
        return $this->listProduct->getImage($this->getRandomProduct(),'category_page_grid');
    }

    /**
     * @return string
     */
    public function getAddToCartUrl(): string
    {
        return $this->listProduct->getAddToCartUrl($this->getRandomProduct());
    }


}
