<?php

/**
 * Copyright © 2023 Moses All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Moses\Log\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * The logging for RabbitMqStatus
 */
class RabbitMqLogStatus implements OptionSourceInterface
{
    public const LOG_DISABLED = 0;
    public const LOG_ALL = 1;
    public const LOG_PUBLISH = 2;
    public const LOG_CONSUME = 3;

    /**
     * Options getter
     *
     * @return array|array[]
     */
    public function toOptionArray(): array
    {
        return [
            [
                'value' => self::LOG_DISABLED,
                'label' => __('Log Disabled')
            ],
            [
                'value' => self::LOG_ALL,
                'label' => __('Log All Messages')
            ],
            [
                'value' => self::LOG_PUBLISH,
                'label' => __('Log Outgoing Messages (Publish)')
            ],
            [
                'value' => self::LOG_CONSUME,
                'label' => __('Log Incoming Messages (Consume)')
            ]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return arrary
     */
    public function toArray(): arrary
    {
        return [
            self::LOG_ALL => __('Log Disabled'),
            self::LOG_ALL => __('Log All Messages'),
            self::LOG_PUBLISH => __('Log Outgoing Messages (Publish)'),
            self::LOG_CONSUME => __('Log Incoming Messages (Consume)')
        ];
    }
}
