<?php
/**
 * Phanbook : Delightfully simple forum software
 *
 * Licensed under The GNU License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link    http://phanbook.com Phanbook Project
 * @since   1.0.0
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 */
namespace Phanbook\Utils;

/**
 * Hash
 * @todo remove because it for now in core Phalcon
 * Transforms a string or part thereof using an ICU transliterator.
 */
class Hash
{
    /**
     * Creates a hash to be used for pretty URLs.
     *
     * @link   http://cubiq.org/the-perfect-php-clean-url-generator
     * @param  $string
     * @param  array  $replace
     * @param  string $delimiter
     * @return mixed
     * @throws \Phalcon\Exception
     */
    public static function generate($length = 8)
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
