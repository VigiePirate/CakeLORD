<?php

namespace App\View\Helper;

use Cake\View\Helper;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

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
    public function parse($text = '')
    {
        return $this->_getParser(['html_input' => 'allow'])->convert($text);
    }

    public function sanitize($text = '')
    {
        return $this->_getParser(['html_input' => 'escape', 'allow_unsafe_links' => false])
            ->convert($text);
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

        $config = [
            'smartpunct' => [
                'double_quote_opener' => __('“'), // to be translated in '« ' in French
                'double_quote_closer' => __('”'), // to be translated in ' »' in French
                'single_quote_opener' => '‘',
                'single_quote_closer' => '’',
                ],
            'table' => [
                'wrap' => [
                    'enabled' => true,
                    'tag' => 'div',
                    'attributes' => ['class' => 'table-md'],
                ],
            ],
        ];

        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new SmartPunctExtension());
        $environment->addExtension(new TableExtension());

        $this->_converter = new MarkdownConverter($environment);
        return $this->_converter;
    }
}
