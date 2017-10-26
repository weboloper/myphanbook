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

use Phalcon\Mvc\Router\Group as RouterGroup;

$api = new RouterGroup([
    'module'     => 'api',
    'controller' => 'posts',
    'action'     => 'index',
    'namespace'  => 'Phanbook\Api\Controllers',
]);

$api->add('/api/:controller/:action/:params', [
    'controller' => 1,
    'action'     => 2,
    'params'     => 3,
]);

$api->add('/api/:controller/:action', [
    'controller' => 1,
    'action'     => 2,
]);

$api->add('/api/:controller/:int', [
    'controller' => 1,
    'id'         => 2,
]);

$api->add('/api/:controller', [
    'controller' => 1,
]);

$api->add('/api/posts/view/{id}/comments', [
    'controller' => 'posts',
    'action'     => 'postComments'
]);

$api->add('/api[/]?', [
    'controller' => 'posts',
]);

return $api;
