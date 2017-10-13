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
namespace Phanbook\Frontend\Controllers;

use Phanbook\Models\Tags;
use Phanbook\Models\Vote;
use Phanbook\Models\Users;
use Phanbook\Models\Karma;
use Phanbook\Models\Posts;
use Phanbook\Models\Comments;
use Phanbook\Controllers\Controller;
use Phalcon\Mvc\DispatcherInterface;
use Phanbook\Models\Services\Service;
use Phanbook\Frontend\Forms\CommentForm;
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
        if ($this->auth->hasRememberMe() && !$this->request->isPost()) {
            $this->auth->loginWithRememberMe();
        }

        return true;
    }

    public function initialize()
    {
        $this->view->setVars(
            [
                'tab'           => $this->currentOrder,
                'tags'          => Tags::find(),
                // 'hotPosts'      => Posts::getHotPosts(5),
                // 'totalPost'     => Posts::totalPost(),
                // 'highestKarma'  => Users::highestKarma(),
                // 'totalReply'    => PostsReply::totalReply(),
            ]
        );
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

    /**
     * Method for voting a task
     *
     * @return mixed
     */
    public function voteAction()
    {
        $this->view->disable();

        $way = 'positive';
        if ($this->request->getPost('way') == 'negative') {
            $way = 'negative';
        }

        $objectId = $this->request->getPost('objectId', 'int');
        $object   = $this->request->getPost('object', 'alphanum');

        $this->setJsonResponse();

        if (!$this->auth->isAuthorizedVisitor() ||
            $user = $this->userService->findFirstById($this->auth->getUserId())
        ) {
            $this->jsonMessages['messages'][] = [
                'type'    => 'error',
                'content' => t('Only authorized users can vote')
            ];

            return $this->jsonMessages;
        }

        $this->db->begin();

        if ($object == Vote::OBJECT_POSTS) {
            if (!$post = $this->postService->findFirstById($objectId)) {
                $this->jsonMessages['messages'][] = [
                    'type'    => 'error',
                    'content' => 'Post does not exist'
                ];
                return $this->jsonMessages;
            }
            $this->setPointPost($way, $user, $post);

            // Adding notification when you have receive vote on the post, and not for now for post replies
            if ($user->getId() != $post->getUsersId()) {
                $this->setActivityNotifications($user, $post);
            }
        }

        if ($object == Vote::OBJECT_POSTS_REPLIES) {
            if (!$postReply = PostsReply::findFirstById($objectId)) {
                $this->jsonMessages['messages'][] = [
                    'type'    => 'error',
                    'content' => 'Post reply does not exist'
                ];
                return $this->jsonMessages;
            }

            // Set karma Voting someone else's post (positive or negative) on posts reply
            $this->setPointReply($way, $user, $postReply);
        }

        $vote = Vote::vote($objectId, $object, $way);

        if (!$vote) {
            $this->db->rollback();
            $this->jsonMessages['messages'][] = [
                'type'    => 'error',
                'content' =>  'Vote have a problem :)'
            ];
            return $this->jsonMessages;
        }

        if ($user->getVote() <= 0) {
            $this->jsonMessages['messages'][] = [
                'type'    => 'error',
                'content' =>  t('You don\'t have enough votes available :)')
            ];
            return $this->jsonMessages;
        }

        //checking the user have already voted this post yet
        if (is_array($vote)) {
            $this->db->rollback();
            $this->jsonMessages['messages'][] = $vote;
            return $this->jsonMessages;
        }

        $this->db->commit();

        if ($this->request->isAjax()) {
            $votes = $this->voteService->getVotes($objectId, $object);
            return ['data' => $votes['positive'] - $votes['negative']];
        }

        echo 0;
        return 0;
    }


    /**
     * Set karma Voting someone else's post (positive or negative) on posts reply.
     *
     * @param string $way
     * @param \Phanbook\Models\Users $user
     * @param \Phanbook\Models\PostsReply $postReply
     * @return array
     */
    public function setPointReply($way, $user, $postReply)
    {
        if ($postReply->getUsersId() != $user->getId()) {
            if ($way == 'positive') {
                if ($postReply->post->getUsersId() != $user->getId()) {
                    $karmaCount = intval(abs($user->getKarma() - $postReply->user->getKarma()) / 1000);
                    $points = Karma::VOTE_UP_ON_MY_REPLY_ON_MY_POST + $karmaCount;
                } else {
                    $points = Karma::VOTE_UP_ON_MY_REPLY;
                    $points += intval(abs($user->getKarma() - $postReply->user->getKarma()) / 1000);
                }
                $postReply->user->increaseKarma($points);
                $user->increaseKarma(Karma::VOTE_UP_ON_SOMEONE_ELSE_REPLY);
            } else {
                if ($postReply->post->getUsersId() != $user->getId()) {
                    $karmaCount = intval(abs($user->getKarma() - $postReply->user->getKarma()) / 1000);
                    $points = Karma::VOTE_DOWN_ON_MY_REPLY_ON_MY_POST + $karmaCount;
                } else {
                    $points = Karma::VOTE_DOWN_ON_MY_REPLY;
                    $points += intval(abs($user->getKarma() - $postReply->user->getKarma()) / 1000);
                }
                $postReply->user->decreaseKarma($points);
                $user->decreaseKarma(Karma::VOTE_DOWN_ON_SOMEONE_ELSE_REPLY);
            }
        }
        if ($postReply->save()) {
            //decrease vote when user up or down post
            $user->setVote($user->getVote() - 1);
            if (!$user->save()) {
                foreach ($user->getMessages() as $message) {
                    $this->jsonMessages['messages'][] = [
                        'type'  => 'error',
                        'message' => $message->getMessage()
                    ];
                    return $this->jsonMessages;
                }
            }
        } else {
            error_log('todo setPointReply');
        }
    }

    /**
     * Set karma Voting someone else's post (positive or negative) on posts
     *
     * @param string $way  positive or negative
     * @param object $user Phanbook\Models\Users
     * @param object $post Phanbook\Models\Posts
     * @return array
     */
    public function setPointPost($way, $user, $post)
    {
        if ($post->getUsersId() != $user->getId()) {
            if ($way == 'positive') {
                $post->user->increaseKarma(Karma::SOMEONE_DID_VOTE_MY_POST);
                $user->increaseKarma(Karma::VOTE_ON_SOMEONE_ELSE_POST);
            } else {
                $post->user->decreaseKarma(Karma::SOMEONE_DID_VOTE_MY_POST);
                $user->increaseKarma(Karma::VOTE_ON_SOMEONE_ELSE_POST);
            }
        }
        if ($post->save()) {
            $user->setVote($user->getVote() - 1);
            if (!$user->save()) {
                foreach ($user->getMessages() as $message) {
                    $this->jsonMessages['messages'][] = [
                        'type'  => 'error',
                        'message' => $message->getMessage()
                    ];
                    return $this->jsonMessages;
                }
            }
        } else {
            $this->saveLogger('todo setPointReply');
        }
    }

    /**
     * These is it will save ActivityNotifications when the user have comment,
     * vote, etc to post or post reply, which just display for user
     *
     * @param  object $user   this is session user Phanbook\Models\Users
     * @param  object $object Phanbook\Models\{Posts, PostsReply...}
     * @return mixed
     */
    public function setActivityNotifications($user, $object)
    {
        $activity = new ActivityNotifications();
        //set user receive a notification when it have a post comment or reply
        $activity->setUsersOriginId($user->getId());

        //If is posts, it will use when user vote post
        if (method_exists($object, 'isPost')) {
            $activity->setUsersId($object->getUsersId());
            $activity->setPostsId($object->getId());
            $activity->setCommentsId(null);
            $activity->setType(ActivityNotifications::TYPE_POSTS);
        }
        if (method_exists($object, 'isComment')) {
            //@todo
        }

        if (method_exists($object, 'isReply')) {
            $activity->setUsersId($object->post->getUsersId());
            $activity->setPostsId($object->post->getId());
            $activity->setCommentsId($object->getId());
            $activity->setType(ActivityNotifications::TYPE_REPLY);
        }

        if (!$activity->save()) {
            $this->saveLogger('Save fail, I am on here' . __LINE__);
        }
    }

    /**
     * Transfer values from the controller to views
     *
     * @param array $params
     */
    public function setViewVariable($params)
    {
        foreach ($params as $key => $value) {
            $this->view->setVar($key, $value);
        }
    }
}
