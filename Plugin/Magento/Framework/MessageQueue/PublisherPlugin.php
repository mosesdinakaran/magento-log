<?php

/**
 * Copyright © 2023 Moses All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Moses\Log\Plugin\Magento\Framework\MessageQueue;

use Exception;
use Magento\Framework\MessageQueue\Publisher;
use Magento\Framework\Serialize\SerializerInterface;
use Moses\Log\Model\Config\Source\RabbitMqLogStatus;
use Moses\Log\Services\Configuration;
use Psr\Log\LoggerInterface;

class PublisherPlugin
{
    private Configuration $configuration;
    private LoggerInterface $logger;
    private SerializerInterface $jsonSerializer;

    /**
     * @param Configuration $configuration
     * @param LoggerInterface $logger
     * @param SerializerInterface $jsonSerializer
     */
    public function __construct(
        Configuration $configuration,
        LoggerInterface $logger,
        SerializerInterface $jsonSerializer
    ) {
        $this->configuration = $configuration;
        $this->logger = $logger;
        $this->jsonSerializer = $jsonSerializer;
    }

    /**
     * @param Publisher $subject
     * @param $topicName
     * @param $data
     * @return array
     */
    public function beforePublish(
        Publisher $subject,
        $topicName,
        $data
    ) {
        try {
            if ($this->configuration->getRabbitMqLoggingStatus() == RabbitMqLogStatus::LOG_ALL ||
                $this->configuration->getRabbitMqLoggingStatus() == RabbitMqLogStatus::LOG_PUBLISH
            ) {
                $logData = [
                    'TOPIC_NAME' => $topicName,
                    'MESSAGE' => $data
                ];
                $this->logger->debug("Message Pushed: " . $this->jsonSerializer->serialize($logData));
            }
        } catch (Exception $e) {
            $this->logger->debug($e->getMessage() . $e->getTraceAsString());
        }
        return [$topicName, $data];
    }
}
