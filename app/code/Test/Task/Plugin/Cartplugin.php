<?php

namespace Test\Task\Plugin;

use Magento\Framework\App\Request\Http;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface as Url;
use Magento\Store\Model\StoreManagerInterface;
use Test\Task\Helper\Data;

class CartPlugin
{
    /**
     * @var Http
     */
    protected $request;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var Url
     */
    protected $url;

    /**
     * @param Data $helper
     * @param Url $url
     * @param Http $request
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Data                  $helper,
        Url                   $url,
        Http                  $request,
        StoreManagerInterface $storeManager)
    {
        $this->helper = $helper;
        $this->url = $url;
        $this->request = $request;
        $this->storeManager = $storeManager;
    }

    /**
     * @param $subject
     * @param $productInfo
     * @param $requestInfo
     * @return array
     * @throws NoSuchEntityException
     */
    public function beforeAddProduct($subject, $productInfo, $requestInfo = null): array
    {
        if ($this->helper->isRedirectEnabled()) {
            $cartUrl = $this->storeManager->getStore()->getBaseUrl() . "checkout/";
            if ($cartUrl != '' && isset($cartUrl)) {
                $accUrl = $this->url->getUrl($cartUrl);
                $this->request->setParam('return_url', $accUrl);
            }
        }

        return [$productInfo, $requestInfo];
    }
}
