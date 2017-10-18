<?php
/**
 * Phanbook : Delightfully simple forum software
 *
 * Licensed under The BSD License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link    http://phanbook.com Phanbook Project
 * @since   1.0.0
 * @license https://github.com/phanbook/phanbook/blob/master/LICENSE.txt
 */
namespace Phanbook\Common\Library\LiveVolt;

use Phanbook\Models\Services\Service;
class LiveVolt extends \Phalcon\Mvc\View\Engine\Volt
{
    public function getCompiler()
    {
        if (empty($this->_compiler))
        {
            $this->_compiler = new LiveVoltCompiler($this->getView());
            $this->_compiler->setOptions($this->getOptions());
            $this->_compiler->setDI($this->getDI());
        }

        return $this->_compiler;
    }
}

class LiveVoltCompiler extends \Phalcon\Mvc\View\Engine\Volt\Compiler
{
    protected function _compileSource($source, $something = null)
    {
        $source = str_replace('{{', '<' . '?php $ng = <<<NG' . "\n" . '\x7B\x7B', $source);
        $source = str_replace('}}', '\x7D\x7D' . "\n" . 'NG;' . "\n" . ' echo $ng; ?' . '>', $source);

        $source = str_replace('[[', '{{', $source);
        $source = str_replace(']]', '}}', $source);

        return parent::_compileSource($source, $something);
    }
}