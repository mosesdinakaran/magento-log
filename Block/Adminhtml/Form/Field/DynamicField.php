<?php

/**
 * Copyright © 2023 Moses All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Moses\Log\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

/**
 * Class DynamicField
 */
class DynamicField extends AbstractFieldArray
{
    /**
     * {@inheritdoc}
     */
    protected function _prepareToRender()
    {
        $this->addColumn('key', ['label' => __('Header Key')]);
        $this->addColumn('value', ['label' => __('Header Value')]);
        $this->_addAfter = false;
    }
}
