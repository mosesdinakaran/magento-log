<?php

/**
 * Copyright © 2023 Moses All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Moses\Log\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * The logging status for API logging
 */
class LoggingStatus implements OptionSourceInterface
{
    const ENABLED_FOR_ALL = 1;
    const ENABLED_FOR_SPECIFIC = 2;
    private const DISABLED = 0;

    /**
     * Options getter
     *
     * @return array|array[]
     */
    public function toOptionArray(): array
    {
        return [
            [
                'value' => self::DISABLED,
                'label' => __('No')
            ],
            [
                'value' => self::ENABLED_FOR_ALL,
                'label' => __('Enable For All Apis')
            ],
            [
                'value' => self::ENABLED_FOR_SPECIFIC,
                'label' => __('Enable For Selected Apis')
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
            self::DISABLED => __('No'),
            self::ENABLED_FOR_ALL => __('Enable For All Apis'),
            self::ENABLED_FOR_SPECIFIC => __('Enable For Selected Apis')
        ];
    }
}
