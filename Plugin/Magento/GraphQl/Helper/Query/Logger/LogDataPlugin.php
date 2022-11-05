<?php

/**
 * Copyright © 2021 Moses, LLC. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Moses\Log\Plugin\Magento\GraphQl\Helper\Query\Logger;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Response\Http as HttpResponse;
use Magento\Framework\GraphQl\Schema;
use Magento\GraphQl\Helper\Query\Logger\LogData;
use Moses\Log\Services\Configuration;

/**
 * Plugin for the class Magento\GraphQl\Helper\Query\Logger\LogData
 * To add more data such as body and response
 */
class LogDataPlugin
{
    /**
     * @var Configuration
     */
    private Configuration $configuration;

    /**
     * @param Configuration $configuration
     */
    public function __construct(
        Configuration $configuration
    ) {
        $this->configuration = $configuration;
    }

    /**
     * Plugin to add few more data to graphql logger
     *
     * @param LogData $subject
     * @param array $logData
     * @param RequestInterface $request
     * @param array $data
     * @param Schema|null $schema
     * @param HttpResponse|null $response
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterGetLogData(
        LogData $subject,
        $logData,
        RequestInterface $request,
        array $data,
        ?Schema $schema,
        ?HttpResponse $response
    ) {
        if ($this->configuration->getGraphqlLoggingStatus()) {
            $logData['body'] = $request->getContent();
            $logData['response'] = ['Content' => $response->getContent()];
        }
        return [$logData];
    }
}
