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
namespace Phanbook\Models;

/**
 * Karma constants
 */
abstract class Karma
{
    const INITIAL_KARMA = 0;

    const LOGIN = 0;

    const ADD_NEW_POST = 0;

    const DELETE_POST = 0;

    const SOMEONE_REPLIED_TO_MY_POST = 0;

    const REPLY_ON_SOMEONE_ELSE_POST = 0;

    const SOMEONE_DELETED_HIS_OR_HER_REPLY_ON_MY_POST = 0;

    const DELETE_REPLY_ON_SOMEONE_ELSE_POST = 0;

    const MODERATE_POST = 0;

    const MODERATE_REPLY = 0;

    const MODERATE_DELETE_POST = 0;

    const MODERATE_DELETE_REPLY = 0;

    const VISIT_ON_MY_POST = 0;

    const MODERATE_VISIT_POST = 0;

    const VISIT_POST = 0;

    const SOMEONE_DID_VOTE_MY_POST = 1;

    const SOMEONE_DID_VOTE_MY_COMMENT = 1;

    const VOTE_ON_SOMEONE_ELSE_POST = 0;

    const VOTE_UP_ON_MY_REPLY_ON_MY_POST = 0;

    const VOTE_UP_ON_MY_REPLY = 0;

    const VOTE_UP_ON_SOMEONE_ELSE_REPLY = 0;

    const VOTE_DOWN_ON_SOMEONE_ELSE_REPLY = 0;

    const VOTE_DOWN_ON_MY_REPLY_ON_MY_POST = 0;

    const VOTE_DOWN_ON_MY_REPLY = 0;

    const SOMEONE_ELSE_ACCEPT_YOUR_REPLY = 0;
}
