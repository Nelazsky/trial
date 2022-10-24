<?php

namespace Test\Task\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;


class Data extends AbstractHelper
{
    const  XML_PATH_CHECKOUT_REDIRECT = 'task/general/checkout_redirect';
    const  XML_PATH_CHECKOUT_BLOCK_TITLE = 'task/general/block_title';

    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @param $store
     * @return bool
     */
    public function isRedirectEnabled($store = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_CHECKOUT_REDIRECT,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * @param $store
     * @return string
     */
    public function getTitle($store = null): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_CHECKOUT_BLOCK_TITLE,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }
}
