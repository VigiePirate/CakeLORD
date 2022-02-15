<?php

namespace App\View\Helper;

use Cake\View\Helper;
use League\CommonMark\CommonMarkConverter;

class CommonmarkHelper extends Helper
{
    protected $_converter;
    /**
     * Parse text as CommonMark
     *
     * @param string $text text to parse
     *
     * @return string
     */
    public function parse($text)
    {
        return $this->_getParser()->convertToHtml($text);
    }

    public function sanitize($text)
    {
        return $this->_getParser(['html_input' => 'escape', 'allow_unsafe_links' => false])
            ->convertToHtml($text);
    }

    /**
     * Get parser
     *
     * @return CommonMarkConverter
     */
    protected function _getParser($options = [])
    {
        if ($this->_converter !== null) {
            return $this->_converter;
        }
        $this->_converter = new CommonMarkConverter($options);
        return $this->_converter;
    }
}
