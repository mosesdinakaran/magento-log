<?php
/**
 * Copyright © 2021 Moses, LLC. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Moses\Log\Services;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Service to get module admin configurations
 */
class Configuration
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**#@+
     * XML path  constants
     */
    const PATH_STATUS = 'dev/moses_logging/status';

    const PATH_URLS = 'dev/moses_logging/urls';
    /**#@-*/

    /**
     * Configuration constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    /**
     * To Get the logging status
     *
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getLoggingStatus()
    {
        return $this->scopeConfig->getValue(
            self::PATH_STATUS,
            ScopeInterface::SCOPE_WEBSITE,
            $this->storeManager->getStore()->getWebsiteId()
        );
    }

    /**
     * To get the logging urls
     *
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getLoggingUrls()
    {
        return $this->scopeConfig->getValue(
            self::PATH_URLS,
            ScopeInterface::SCOPE_WEBSITE,
            $this->storeManager->getStore()->getWebsiteId()
        );
    }
}
