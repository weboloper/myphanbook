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

use Phanbook\Search\Indexer;
use Phanbook\Models\Posts;
use Phalcon\Mvc\View;

/**
 * Class SearchController
 */
class SearchController extends ControllerBase
{
    /**
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|View
     */
    public function indexAction()
    {
        $this->tag->setTitle('Search Results');
        $q = $this->request->getQuery('q', 'string');
        $indexer = new Indexer();
        $posts = $indexer->search(['title' => $q, 'content' => $q], 50, true);

        if (!count($posts)) {
            $posts = $indexer->search(['title' => $q], 50, true);

            if (!count($posts)) {
                $this->flashSession->notice('There are no search results');
                return $this->response->redirect();
            }
        }

        $this->view->setVars(
            [
                'tab'           => null,
                'posts'         => $posts,
                'canonical'     => '',
                'totalPages'    => 1,
                'currentPage'   => null
            ]
        );
        return $this->view->pick('post');
    }
    /**
     * Finds related posts
     */
    public function showRelatedAction()
    {
        $this->view->disable();
        if ($this->request->isAjax()) {
            //$this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $post = Posts::findFirstById($this->request->getPost('id'));
            if ($post) {
                $posts = Posts::postRelated($post);
                if (count($posts) > 0) {
                    $params = ['posts' => $posts];
                    echo $this->view->getRender(
                        'partials',
                        'list-posts',
                        $params,
                        function ($view) {
                            $view->setRenderLevel(View::LEVEL_ACTION_VIEW);
                        }
                    );
                }
            }
        }
    }
}
