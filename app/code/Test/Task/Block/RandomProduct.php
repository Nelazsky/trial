<?php

namespace Test\Task\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Test\Task\Helper\Data;

class RandomProduct extends Template
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @param Data $helper
     * @param Context $context
     */
    public function __construct(
        Data    $helper,
        Context $context
    )
    {
        parent::__construct($context);
        $this->helper = $helper;
    }

    /**
     * @return string
     */
    public function getBlockTitle(): string
    {
        return $this->helper->getTitle();
    }

}
