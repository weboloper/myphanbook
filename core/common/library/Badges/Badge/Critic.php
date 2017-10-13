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
namespace Phanbook\Badges\Badge;

use Phanbook\Models\Users;
use Phanbook\Models\Vote;
use Phanbook\Badges\BadgeBase;

/**
 * Phanbook\Badges\Badge\Supporter
 *
 * First negative vote to another user
 */
class Critic extends BadgeBase
{
    protected $name = 'Critic';

    protected $description = 'First negative vote';

    /**
     * Check whether the user can have the badge
     *
     * @param  Users $user
     * @return boolean
     */
    public function canHave(Users $user)
    {
        $canHave = Vote::count(
            [
            'usersId = ?0 AND negative = 1',
            'bind' => [$user->getId()]
            ]
        ) > 0;
        return $canHave;
    }
}
