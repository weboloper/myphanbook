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
namespace Phanbook\Frontend\Forms;

use Phanbook\Models\Users;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Radio;

class UserSettingForm extends Form
{
    public function initialize(Users $entity = null)
    {
        // In edit page the id is hidden
        if (!is_null($entity)) {
            $this->add(new Hidden('id'));
        }


        // Phanbook weekly digest
        if (!empty($entity) && $entity->getDigest() == Users::DIGEST_YES ||
            $this->request->getPost('digestYes') == Users::DIGEST_YES
        ) {
            $this->add(
                new Radio(
                    'digestYes',
                    ['value' => Users::DIGEST_YES, 'checked' => 'checked', 'name' => 'digest']
                )
            );
        } else {
            $this->add(new Radio('digestYes', ['value' => Users::DIGEST_YES, 'name' => 'digest']));
        }

        if (!empty($entity) && $entity->getDigest() == Users::DIGEST_NO ||
            $this->request->getPost('digest') == Users::DIGEST_NO
        ) {
            $this->add(
                new Radio(
                    'digestNo',
                    ['value' => Users::DIGEST_NO, 'checked' => 'checked', 'name' => 'digest']
                )
            );
        } else {
            $this->add(new Radio('digestNo', ['value' => Users::DIGEST_NO, 'name' => 'digest']));
        }

        // Notification
        $this->add(
            new Select(
                'notifications',
                [
                    Users::NOTIFY_N => 'Never receive an e-mail notification',
                    Users::NOTIFY_Y => 'Receive e-mail notifications from all new threads and comments',
                    Users::NOTIFY_P => 'When someone replies to a discussion that I started or replied to'
                ]
            )
        );

        // Timezone
        /** @noinspection PhpIncludeInspection */
        $timezones = require config_path('timezone.php');
        $this->add(new Select('timezone', $timezones));

        // Submit
        $this->add(
            new Submit(
                'save',
                [
                    'value' => 'Save',
                    'class' => 'button color small login-submit submit'
                ]
            )
        );
    }
}
