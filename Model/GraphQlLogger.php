<?php
/**
 *  Copyright © 2021 Alshaya, LLC. All rights reserved.
 *  See LICENSE.txt for license details.
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
    private $logger;

    /**
     * @var Configuration
     */
    private $configuration;

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
     * @param array $data
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute($data)
    {
        if ($this->configuration->getGraphqlLoggingStatus()) {
            $this->logger->debug("Graphql Log Data: " . json_encode($data));
        }
    }
}
