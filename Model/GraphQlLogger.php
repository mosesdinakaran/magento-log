<?php

/**
 * Copyright © 2023 Moses All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Moses\Log\Model;

use Moses\Log\Services\Configuration;
use Psr\Log\LoggerInterface;

/**
 * Class GraphQlLogger to log graphql request and response
 */
class GraphQlLogger
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var Configuration
     */
    private Configuration $configuration;

    /**
     * @param Configuration $configuration
     * @param LoggerInterface $logger
     */
    public function __construct(
        Configuration $configuration,
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
        $this->configuration = $configuration;
    }

    /**
     * This method will be called from here
     * \Magento\GraphQl\Model\Query\Logger\LoggerPool::execute
     *
     * @param array $queryDetails
     * @return void
     */
    public function execute(array $queryDetails)
    {
        foreach($queryDetails as $data) {
            if (isset($data['GraphQLCustomLogging'])
                && $data['GraphQLCustomLogging']) {
                $this->logger->debug("Graphql Log Data: " . json_encode($data['GraphQLCustomLogging']));
                break;
            }
        }
    }
}
