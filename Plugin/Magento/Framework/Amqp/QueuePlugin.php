<?php

/**
 * Copyright © 2023 Moses All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Moses\Log\Plugin\Magento\Framework\Amqp;

use Magento\Framework\Amqp\Queue;
use Magento\Framework\MessageQueue\EnvelopeInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Moses\Log\Model\Config\Source\RabbitMqLogStatus;
use Moses\Log\Services\Configuration;
use Psr\Log\LoggerInterface;

class QueuePlugin
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


    public function beforeAcknowledge(
        Queue $subject,
        EnvelopeInterface $envelope
    ) {
        try {
            if ($this->configuration->getRabbitMqLoggingStatus() == RabbitMqLogStatus::LOG_ALL ||
                $this->configuration->getRabbitMqLoggingStatus() == RabbitMqLogStatus::LOG_CONSUME
            ) {
                $properties = $envelope->getProperties();
                $logData = [
                    'TOPIC_NAME' => $properties['topic_name'] ?? '',
                    'MESSAGE' => $envelope->getBody()
                ];
                $this->logger->debug("MESSAGE RECEIVED: " . $this->jsonSerializer->serialize($logData));
            }
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage() . $e->getTraceAsString());
        }
        return [$envelope];
    }
}
