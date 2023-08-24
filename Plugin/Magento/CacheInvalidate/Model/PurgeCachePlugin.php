<?php

/**
 * Copyright © 2023 Moses All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Moses\Log\Plugin\Magento\CacheInvalidate\Model;

use Exception;
use Magento\CacheInvalidate\Model\PurgeCache;
use Magento\Framework\Serialize\SerializerInterface;
use Moses\Log\Services\Configuration;
use Psr\Log\LoggerInterface;

/**
 * Class PurgeCachePlugin
 * The Plugin Class to \Magento\CacheInvalidate\Model\PurgeCache
 */
class PurgeCachePlugin
{
    /**
     * @var Configuration
     */
    private Configuration $configuration;

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $jsonSerializer;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param Configuration $configuration
     * @param SerializerInterface $jsonSerializer
     * @param LoggerInterface $logger
     */
    public function __construct(
        Configuration $configuration,
        SerializerInterface $jsonSerializer,
        LoggerInterface $logger
    ) {
        $this->configuration = $configuration;
        $this->jsonSerializer = $jsonSerializer;
        $this->logger = $logger;
    }

    /**
     * @param PurgeCache $subject
     * @param $result
     * @param $tags
     * @return mixed
     */
    public function afterSendPurgeRequest(
        PurgeCache $subject,
                   $result,
                   $tags
    ) {
        try {
            if (!$this->configuration->getVarnishLoggingStatus()) {
                return $result;
            }
            if (!$result) {
                $this->logger->info(
                    "Looks Like there is Some issue is Purging the Varnish Cache,
                    Check if varnish purge server is configured"
                );
            }
            $this->logger->info("Varnish Cache Tags For Purging: " . $this->jsonSerializer->serialize($tags));
        } catch (Exception $e) {
            $this->logger->info($e->getMessage() . $e->getTraceAsString());
        }
        return $result;
    }
}
