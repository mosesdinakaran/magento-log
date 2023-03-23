<?php

/**
 * Copyright © 2023 Moses All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Moses\Log\Services;

use Exception;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Service to get module admin configurations
 */
class Configuration
{
    private ScopeConfigInterface $scopeConfig;

    private StoreManagerInterface $storeManager;

    private SerializerInterface $serializer;

    /**#@+
     * XML path  constants
     */
    private const PATH_API_STATUS = 'moses_log/rest/status';
    private const PATH_API_URLS = 'moses_log/rest/urls';
    private const PATH_ES_STATUS = 'moses_log/es/status';
    private const PATH_GRAPHQL_STATUS = 'moses_log/graphql/status';
    private const PATH_GRAPHQL_HEADER = 'moses_log/graphql/header';
    private const PATH_GRAPHQL_HTTP_METHODS = 'moses_log/graphql/http_methods';
    private const PATH_GRAPHQL_QUERY_TYPE = 'moses_log/graphql/query_type';
    private const PATH_RABBITMQ_STATUS = 'moses_log/rabbitmq/status';
    private const PATH_VARNISH_STATUS = 'moses_log/varnish/status';
    /**#@-*/

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        SerializerInterface $serializer
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->serializer = $serializer;
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

    /**
     * @return array
     */
    public function getGraphqlHeader()
    {
        $returnValue = [];
        try {
            $header = $this->scopeConfig->getValue(
                self::PATH_GRAPHQL_HEADER,
                ScopeInterface::SCOPE_WEBSITE,
                $this->storeManager->getStore()->getWebsiteId()
            );
            if ($header) {
                $returnValue = $this->serializer->unserialize($header);
            }
        } catch (Exception $exception) {
            // Nothing to do
        }
        return $returnValue;
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getGraphqlHttpMethods()
    {
        return $this->scopeConfig->getValue(
            self::PATH_GRAPHQL_HTTP_METHODS,
            ScopeInterface::SCOPE_WEBSITE,
            $this->storeManager->getStore()->getWebsiteId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getGraphqlQueryType()
    {
        return $this->scopeConfig->getValue(
            self::PATH_GRAPHQL_QUERY_TYPE,
            ScopeInterface::SCOPE_WEBSITE,
            $this->storeManager->getStore()->getWebsiteId()
        );
    }

    /**
     * To Get the Varnish logging status
     *
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getVarnishLoggingStatus()
    {
        return $this->scopeConfig->getValue(
            self::PATH_VARNISH_STATUS,
            ScopeInterface::SCOPE_WEBSITE,
            $this->storeManager->getStore()->getWebsiteId()
        );
    }

    /**
     * To Get the RabbitMQ logging status
     *
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getRabbitMqLoggingStatus()
    {
        return $this->scopeConfig->getValue(
            self::PATH_RABBITMQ_STATUS,
            ScopeInterface::SCOPE_WEBSITE,
            $this->storeManager->getStore()->getWebsiteId()
        );
    }
}
