<?php
/**
 * Phanbook : Delightfully simple forum and Q&A software
 *
 * Licensed under The BSD License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link    http://phanbook.com Phanbook Project
 * @since   1.0.0
 * @author  Phanbook <hello@phanbook.com>
 * @license https://github.com/phanbook/phanbook/blob/master/LICENSE.txt
 */
namespace Phanbook\Frontend\Controllers;

/**
 * Class RouterController
 * This class to router page
 *
 * @package Phanbook\Frontend\Controllers
 */
class RouterController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->view->pick('page');
    }

    /**
     * indexAction function.
     */
    public function indexAction()
    {
        $router = $this->dispatcher->getParam('router');
        if (empty($router)) {
            $router = 'page';
        }
        $this->view->page = $this->phanbook->getPostBySlug($router);
        $this->view->tab = $router;

        if (file_exists($this->phanbook->getPageFile($router))) {
            return $this->view->pick('pages/' . $router);
        }

        return $this->view->pick('page');
    }
}
