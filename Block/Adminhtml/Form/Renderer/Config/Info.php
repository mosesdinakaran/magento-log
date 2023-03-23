<?php

/**
 * Copyright © 2023 Moses All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace Moses\Log\Block\Adminhtml\Form\Renderer\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Info extends Field
{
    /**
     * @param AbstractElement $element
     * @return string
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return '<div>
<h3>This is a light weight logging module implemented mostly with Plugins. No Core File is being overriden or modified</h3>
<h3>This has been tested with Magento Lagest Verion, If in case its not working as expected or has bugs please mail me at <strong>mosesdinakaran@gmail.com</strong></h3>
 <h3><a href="https://github.com/mosesdinakaran/magento-log/issues" target="_blank">Alternatically you can also create a bug here</a></h3>
 <h3>Log file will be generated in MAGE_ROOT/var/log/moses-logging.log</h3>
 <h3><strong style="color: darkred">CAUTION :</strong>This extension is for debugging purpose only, Once enabled this extension will write data to the log file based on your configuration, So please be advised keeping this extension enabled for a long time will fill up your disk space. So once the debugging is completed please disable the logging</h3>
</div>';
    }
}
