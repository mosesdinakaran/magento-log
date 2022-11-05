<?php
/**
 * Copyright © 2021 Moses, LLC. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Moses\Log\Services;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Exception\NoSuchEntityException;

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
    private const PATH_API_STATUS = 'moses_log/rest/status';
    private const PATH_API_URLS = 'moses_log/rest/urls';
    private const PATH_ES_STATUS = 'moses_log/es/status';
    private const PATH_GRAPHQL_STATUS= 'moses_log/graphql/status';
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
     * @throws NoSuchEntityException
     */
    public function getApiLoggingStatus()
    {
        return $this->scopeConfig->getValue(
            self::PATH_API_STATUS,
            ScopeInterface::SCOPE_WEBSITE,
            $this->storeManager->getStore()->getWebsiteId()
        );
    }

    /**
     * To get the logging urls
     *
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getApiLoggingUrls()
    {
        return $this->scopeConfig->getValue(
            self::PATH_API_URLS,
            ScopeInterface::SCOPE_WEBSITE,
            $this->storeManager->getStore()->getWebsiteId()
        );
    }

    /**
     * To Get the ES logging status
     *
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getEsLoggingStatus()
    {
        return $this->scopeConfig->getValue(
            self::PATH_ES_STATUS,
            ScopeInterface::SCOPE_WEBSITE,
            $this->storeManager->getStore()->getWebsiteId()
        );
    }

    /**
     * To Get the Graphql logging status
     *
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getGraphqlLoggingStatus()
    {
        return $this->scopeConfig->getValue(
            self::PATH_GRAPHQL_STATUS,
            ScopeInterface::SCOPE_WEBSITE,
            $this->storeManager->getStore()->getWebsiteId()
        );
    }



}
