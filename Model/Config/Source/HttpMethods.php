<?php

/**
 * Copyright © 2023 Moses All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Moses\Log\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * The logging HTTP Methods
 */
class HttpMethods implements OptionSourceInterface
{
    public const HTTP_ALL = 'ALL';
    public const HTTP_GET = 'GET';
    public const HTTP_POST = 'POST';

    /**
     * Options getter
     *
     * @return array|array[]
     */
    public function toOptionArray(): array
    {
        return [
            [
                'value' => self::HTTP_ALL,
                'label' => __('Log All Http Methods')
            ],
            [
                'value' => self::HTTP_GET,
                'label' => __('Log only GET requests')
            ],
            [
                'value' => self::HTTP_POST,
                'label' => __('Log only POST requests')
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
            self::HTTP_ALL => __('Log All Http Methods'),
            self::HTTP_GET => __('Log only GET requests'),
            self::HTTP_POST => __('Log only POST requests')
        ];
    }
}
