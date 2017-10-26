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
namespace Phanbook\Api\Controllers;

use Phanbook\Models\Tags;
use Phanbook\Models\Vote;
use Phanbook\Models\Users;
use Phanbook\Models\Karma;
use Phanbook\Models\Posts;
use Phanbook\Models\Comments;
use Phanbook\Controllers\Controller;
use Phalcon\Mvc\DispatcherInterface;
use Phanbook\Models\Services\Service;
use Phanbook\Models\ActivityNotifications;

/**
 * \Phanbook\Frontend\Controllers\ControllerBase
 *
 * @property \Phanbook\Auth\Auth $auth
 * @property \Phalcon\Config $config
 * @property \Phanbook\Utils\Phanbook $phanbook
 *
 * @package Phanbook\Controllers
 */
class ControllerBase extends Controller
{
    /**
     * @var int
     */
    public $perPage = 30;

    /**
     * @var Service\Post
     */
    protected $postService;

    /**
     * @var Service\User
     */
    protected $userService;

    /**
     * @var Service\Vote
     */
    protected $voteService;

    /**
     * Triggered before executing the controller/action method.
     *
     * @param  DispatcherInterface $dispatcher
     * @return bool
     */
    public function beforeExecuteRoute(DispatcherInterface $dispatcher)
    {
       
    }

    public function initialize()
    {
        $this->response->setContentType('application/json', 'UTF-8');
        $this->view->disable();
        if (isset($this->config->perPage)) {
            $this->perPage = $this->config->perPage;
        }
    }

    public function inject(Service\Post $postService, Service\User $userService, Service\Vote $voteService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
        $this->voteService = $voteService;
    }

}