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
namespace Phanbook\Backend\Controllers;

use Phalcon\Mvc\View;
use Phanbook\Backend\Forms\StickyForm;
use Phanbook\Backend\Forms\PostsForm;
use Phanbook\Models\Posts;
use Phanbook\Utils\Slug;
use Phanbook\Utils\Editor;

/**
 * Class IndexController
 */
class PostsController extends ControllerBase
{
    /**
     * Initiate grid
     */
    protected static function setGrid()
    {
        parent::$grid = [
            'grid' =>[
                'title'    => [
                    'title'  => t('Title'),
                    'order'  => true,
                    'filter' => ['type' => 'input', 'sanitize' => 'string', 'style' => ''],
                ],
                'type' => [
                    'title'  => t('Type'),
                    'order'  => true,
                    'filter' => ['type' => 'input', 'sanitize' => 'string', 'style' => ''],
                ],
                'sticked' => [
                    'title'  => t('Sticked'),
                    'order'  => true,
                    'filter' => ['type' => 'input', 'sanitize' => 'string', 'style' => ''],
                ],
                'status' => [
                    'title'  => t('Status'),
                    'order'  => true,
                    'orderKey'  => 'a.status',
                    'filter' => ['type' => 'input', 'sanitize' => 'string', 'style' => ''],
                    'filterKey'  => 'a.status',

                ],
                'username' => [
                    'title'  => t('Users'),
                    'order'  => true,
                    'filter' => ['type' => 'input', 'sanitize' => 'string', 'style' => ''],
                ],

                'null'    => ['title' => t('Actions')]
            ],
            'query' => [
                'columns' => [
                    'a.id',
                    'a.title',
                    'a.type',
                    'a.sticked',
                    'a.status',
                    'u.username',
                    'a.deleted'
                ],
                'joins' => [
                    [
                        'type' => 'join',
                        'model' => 'Users',
                        'on' => 'a.usersId = u.id',
                        'alias' => 'u'
                    ]
                ],
                'where' => 'a.type != "pages" AND a.deleted = 0'
            ]
        ];
    }

    /**
     * indexAction function.
     *
     * @access public
     * @return void
     */
    public function indexAction()
    {
        if (empty(parent::$grid)) {
            self::setGrid();
        }

        $this->renderGrid('Posts');
        $this->view->setVars(['grid' => parent::$grid]);
        $this->tag->setTitle(t('List posts'));

        if ($this->request->isAjax()) {
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->pick('partials/grid');
        }
    }

    /**
     * indexAction function.
     *
     * @access public
     * @return void
     */
    public function stickyAction()
    {
        if (empty(parent::$grid)) {
            self::setGrid();
        }

        $this->renderGrid('Posts');
        $this->view->setVars(['grid' => parent::$grid]);
        $this->tag->setTitle(t('Sticky at top of lists'));

        if ($this->request->isAjax()) {
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->pick('partials/grid');
        }
    }

    public function newStickyAction()
    {
        $this->view->form = new StickyForm;
        $this->tag->setTitle('Adding sticked');
        $this->view->pick($this->router->getControllerName() . '/itemSticky');
    }

    /**
     * Create a new post
     *
     * @return mixed
     */
    public function newAction()
    {
        $editor = new Editor();
        $editor->init();
        $this->view->form = new PostsForm;
        $this->tag->setTitle('Adding post');
        $this->addAssetsSelect();
        $this->view->pick($this->router->getControllerName() . '/item');
    }

    public function editAction($id)
    {
        if (!$object = Posts::findFirstById($id)) {
            $this->flashSession->error(t("Posts doesn't exist."));

            return $this->currentRedirect();
        }
        $editor = new Editor();
        $editor->init();

        $this->tag->setTitle(t('Edit posts'));
        $this->view->form   = new PostsForm($object);
        $this->view->object = $object;
        $this->addAssetsSelect();

        return $this->view->pick($this->router->getControllerName() . '/item');
    }

    /**
     * @param $id
     *
     * @return \Phalcon\Http\ResponseInterface
     */
    public function editStickyAction($id)
    {
        if (!$object = Posts::findFirstById($id)) {
            $this->flashSession->error(t("Posts doesn't exist."));

            return $this->currentRedirect();
        }
        $this->tag->setTitle(t('Edit sticked'));
        $this->view->form   = new StickyForm($object);
        $this->view->object = $object;

        return $this->view->pick($this->router->getControllerName() . '/itemSticky');
    }

    public function saveStickyAction()
    {
        if (!$this->request->isPost()) {
            $this->flashSession->error(t('Hack attempt!!!'));
            return $this->currentRedirect();
        }
        $id = $this->request->getPost('id');

        if (!$object = Posts::findFirstById($id)) {
            $this->flashSession->error(t('The post not exist'));
            return $this->currentRedirect();
        }
        $object->setSticked($this->request->getPost('sticked'));
        if (!$object->save()) {
            $this->saveLogger($object->getMessages());
            return false;
        }
        $this->flashSession->success(t('Data was successfully saved'));
        return $this->response->redirect('admin/posts/sticky');
    }

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function saveAction()
    {
        $this->view->disable();
        //  Is not $_POST
        if (!$this->request->isPost()) {
            return $this->indexRedirect();
        }

        $id = $this->request->getPost('id');
        $tags = $this->request->getPost('tags', 'string', null);
        if (!empty($id)) {
            $object = Posts::findFirstById($id);
        } else {
            $object = new Posts();
            //@todo
        }
        $object->setSlug(Slug::generate($this->request->getPost('title')));
        $object->setUsersId($this->auth->getUserId());
        $form = new PostsForm($object);
        $form->bind($_POST, $object);

        //  Form isn't valid
        if (!$form->isValid($this->request->getPost())) {
            $this->saveLogger($form->getMessages());
            // Redirect to edit form if we have an ID in page, otherwise redirect to add a new item page
            return $this->response->redirect(
                $this->getPathController().(!is_null($id) ? '/edit/'.$id : '/new')
            );
        }

        $object->setStatus(Posts::PUBLISH_STATUS);
        //Save post to draft
        if ($this->request->getPost('saveDraft')) {
            $object->setStatus(Posts::DRAFT_STATUS);
        }
        if (!$object->save()) {
            $this->saveLogger($object->getMessages());
            return $this->dispatcher->forward(
                ['controller' => $this->getPathController(), 'action' => 'new']
            );
        }

        $this->phanbook->tag()->saveTagsInPosts($tags, $object);
        $this->flashSession->success(t('Data was successfully saved'));

        return $this->indexRedirect();
    }

    /**
     *
     * @return mixed
     */
    protected function addAssetsSelect()
    {
        $this->assets->addCss('core/assets/js/select/select2.min.css');
        $this->assets->addJs('core/assets/js/select/select2.min.js');
    }
}
