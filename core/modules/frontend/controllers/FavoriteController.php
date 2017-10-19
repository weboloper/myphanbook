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

use Phanbook\Models\Posts;
use Phanbook\Models\Subscribe;
use Phanbook\Models\Favorite;

/**
 * Class SubscribeController
 */
class FavoriteController extends ControllerBase
{
    /**
     * Subscribe to a post to receive e-mail notifications
     *
     * @return mixed
     */
    public function indexAction()
    {
        $this->view->disable();
        $this->setJsonResponse();

        if (!$this->request->isPost()) {
            return false;
        }

        //Find the post by Id
        $post = Posts::findFirstById($this->request->getPost('objectId'));
        if (!$post) {
            $this->jsonMessages['messages'][] = [
                'type'    => 'danger',
                'content' => 'The Post does not exist'
            ];
            return $this->jsonMessages;
        }

        /**
         * The test for user authorization
         */
        if (!$this->auth->isAuthorizedVisitor()) {
            $this->jsonMessages['messages'][] = [
                'type'    => 'danger',
                'content' => 'You must log in first to favorite post'
            ];

            return $this->jsonMessages;
        }

        $userId = $this->auth->getUserId();
        $subscription = Favorite::findFirst(
            [
            'postsId = ?0 AND usersId = ?1',
            'bind' => [$post->getId(), $userId]
            ]
        );
        if (!$subscription) {
            $subscription = new Favorite();
            $subscription->setPostsId($post->getId());
            $subscription->setUsersId($userId);
            if (!$subscription->save()) {
                foreach ($subscription->getMessages() as $message) {
                    $this->logger->error('Subscribe save false '. $message . __LINE__ .'and'. __CLASS__);
                }
                return false;
            }
            $this->jsonMessages['messages'][] = [
                'type'    => 'info',
                'content' => 'You have just favorited post',
                'flag'    => 1
            ];
            return $this->jsonMessages;
        } else {
            // unsubscribe posts
            if (!$subscription->delete()) {
                foreach ($subscription->getMessages() as $message) {
                    $this->logger->error('Unfavorite delete false '. $message . __LINE__ .'and'. __CLASS__);
                }
                return false;
            }
            $this->jsonMessages['messages'][] = [
                'type'    => 'info',
                'content' => 'You have just unfavorited post',
                'flag'    => 0
            ];
            return $this->jsonMessages;
        }
    }
    /**
     * Get the weekly newsletter!
     * @todo   implement
     * @return mixed
     */
    public function weeklyAction()
    {
        if (!$this->request->isPost()) {
            return false;
        }
        $email = $this->request->getPost('email');
        if (!$email) {
            $this->flashSession->error(t('Please input your Email'));
            return $this->indexRedirect();
        }
        $subscribe = new Subscribe();
        $subscribe->setStatus('Y');
        $subscribe->setEmail($email);

        if (!$subscribe->save()) {
            foreach ($subscribe->getMessages() as $message) {
                $this->flashSession->error($message);
                return $this->indexRedirect();
            }
        }
        $this->flashSession->success(t('Thank you for subscribing to our newsletter'));
        return $this->indexRedirect();
    }
}
