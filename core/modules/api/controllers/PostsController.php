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

use Phanbook\Utils\Slug;
use Phanbook\Models\Vote;
use Phanbook\Utils\Editor;
use Phanbook\Models\Posts;
use Phanbook\Models\Comments;
use Phanbook\Models\Karma;
use Phanbook\Models\Users;
use Phanbook\Models\ModelBase;
use Phanbook\Models\PostsHistory;
use Phanbook\Frontend\Forms\ReplyForm;
use Phanbook\Frontend\Forms\CommentForm;
use Phanbook\Frontend\Forms\QuestionsForm;

/**
 * \Phanbook\Frontend\Controllers\PostsController
 *
 * @package Phanbook\Frontend\Controllers
 */
class PostsController extends ControllerBase
{	

	public function indexAction(){
		 return print('api version 1.0');

		 // setStatusCode(401, "Unauthorized")
		 // setStatusCode(200, "OK");
		 // setStatusCode(404, 'Not Found')
	}

	public function viewAction($id)
    {

    	$post = $this->postService->findFirstById($id);

        if (!$post || !$this->postService->isPublished($post)) {
            $this->response->setStatusCode(404, 'Not Found');
            return;
        }

        $this->response->setStatusCode(200, "OK");
        return $this->response->setJsonContent([$post, $post->getUser()]);

    }


    public function postCommentsAction($id)
    {
    	$post = $this->postService->findFirstById($id);
    	if (!$post || !$this->postService->isPublished($post)) {
            $this->response->setStatusCode(404, 'Not Found');
            return;
        }

    	$comments = $post->getCommentsWithVotes($id);

    	$this->response->setStatusCode(200, "OK");
    	return $this->response->setJsonContent($comments->toArray());

    }
}
