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

use Phanbook\Models\ActivityNotifications;
use Phanbook\Notifications\Checker;

/**
 * Class NotificationController
 */
class NotificationController extends ControllerBase
{



    public function indexAction()
    {

        $usersId = $this->auth->getAuth()['id'];
        if (!$usersId) {
            return false;
        }

        $notifications = ActivityNotifications::find(
            array(
            'usersId = ?0',
            'bind'  => array($usersId),
            'limit' => 25,
            'order' => 'createdAt DESC'
            )
        );

        $notifies = ActivityNotifications::find(
                    [
                    'usersId = ?0',
                    'bind' => [$usersId]
                    ]
                );

        if ($notifies) {

                foreach ($notifies as $notify) {
                     $notify->setWasRead('Y');
                        if (!$notify->save()) {
                            $this->saveLogger($notify->getMessages());
                        }
                }
            }


        $this->view->setVars(
            [
                'notifications'       => $notifications
            ]
        );

    }

    public function getNotifyAction()
    {
        $this->view->disable();
        $usersId = $this->auth->getUserId();

        $this->setJsonResponse();

        if ($this->request->isPost()) {

            $notifications = $this->notifications->getNotifications($usersId);

            $data = "";
            foreach ($notifications as $notification) {
                $data .='<span class="dropdown-item"><strong>'.$notification->userOrigin->username. '</strong> "'.$notification->post->title.'" için yorum ekledi.</span>';
            }

             return ['data' =>  $data];
  
        }

    }



    public function readnotifyAction()
    {
        $this->view->disable();
        $usersId = $this->auth->getUserId();
        if ($this->request->isPost()) {
            $id = $this->request->getPost('id');
            $object = $this->request->getPost('object');
            if ($object == ActivityNotifications::TYPE_POSTS) {
                $notify = ActivityNotifications::findFirst(
                    [
                    'usersId = ?0 AND postsId = ?1',
                    'bind' => [$usersId, $id]
                    ]
                );
            } else {
                $notify = ActivityNotifications::findFirst(
                    [
                    'usersId = ?0 AND commentsId = ?1',
                    'bind' => [$usersId, $id]
                    ]
                );
            }
            if ($notify) {
                $notify->setWasRead('Y');
                if (!$notify->save()) {
                    $this->saveLogger($notify->getMessages());
                }
            }
        }
    }
}
