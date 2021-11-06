<?php
/**
 * Copyright © Moses, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Moses\Log\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class LoggingStatus implements OptionSourceInterface
{
    const ENABLED_FOR_ALL = 1;
    const ENABLED_FOR_SPECIFIC = 2;
    const DISABLED = 0;

    /**
     * Options getter
     *
     * @return array|array[]
     */
    public function toOptionArray(): array
    {
        return [
            [
                'value' => 0,
                'label' => __('No')
            ],
            [
                'value' => 1,
                'label' => __('Enable For All Apis')
            ],
            [
                'value' => 2,
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
            0 => __('No'),
            1 => __('Enable For All Apis'),
            2 => __('Enable For Selected Apis')
        ];
    }
}
