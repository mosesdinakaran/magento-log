<?php

/**
 * Copyright © 2021 Moses, LLC. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Moses\Log\Plugin\Magento\Elasticsearch\Model;

use Moses\Log\Services\Configuration;
use Magento\Elasticsearch\Model\Config;
use Psr\Log\LoggerInterface;

/**
 * Class ConfigPlugin
 * The Plugin Class to Magento\Elasticsearch\Model\Config to enable ES logging
 */
class ConfigPlugin
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Configuration $configuration
     * @param LoggerInterface $logger
     */
    public function __construct(
        Configuration $configuration,
        LoggerInterface $logger
    ) {
        $this->configuration = $configuration;
        $this->logger = $logger;
    }

    /**
     * Define the ES logger in to the $options array
     *
     * @param Config $subject
     * @param array $options
     * @return array|mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterPrepareClientOptions(
        Config $subject,
        $options = []
    ) {
        if ($this->configuration->getEsLoggingStatus()) {
            $options['logger'] = $this->logger;
        }
        return $options;
    }
}
