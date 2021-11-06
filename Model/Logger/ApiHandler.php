<?php
/**
 * Copyright © 2021 Moses, LLC. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Moses\Log\Model\Logger;

use Monolog\Logger;
use Magento\Framework\Logger\Handler\Base;

/**
 * Class ApiHandler
 * The Handler class for API logging
 */
class ApiHandler extends Base
{
    /**
     * @var int
     */
    protected $loggerType = Logger::INFO;

    /**
     * @var string
     */
    protected $fileName = '/var/log/moses-api-debug.log';
}
