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
use Phanbook\Badges\BadgeBase;

/**
 * Phanbook\Badges\Badge\FamousQuestion
 * @todo  later
 * Asked a question with more than 10000 views
 */
class FamousQuestion extends BadgeBase
{
    protected $name = 'Famous Question';

    protected $description = 'Asked a question with more than 10000 views';

    /**
     * Check whether the user already have this badge
     *
     * @param  Users $user
     * @return boolean
     */
    public function has(Users $user)
    {
    }

    /**
     * Check whether the user can have the badge
     *
     * @param  Users $user
     * @return boolean
     */
    public function canHave(Users $user)
    {
    }

    /**
     * Add the badge to the user
     *
     * @param Users $user
     * @param array $extra
     */
    public function add(Users $user, $extra = null)
    {
    }
}
