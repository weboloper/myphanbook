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
namespace Phanbook\Badges;

use Phanbook\Models\Users;

/**
 * Phanbook\Badges\Manager
 */
class Manager
{
    /**
     * Returns instances of all available badges
     *
     * @return array
     */
    public function getBadges()
    {
        $badges = array();
        $directory = new \RecursiveDirectoryIterator(__DIR__ . '/Badge');
        foreach ($directory as $item) {
            if ($item->isDir()) {
                continue;
            }

            $path = $item->getPathname();
            $baseClassName = str_replace('.php', '', basename($path));
            $className = 'Phanbook\Badges\Badge\\' . $baseClassName;

            $badges[] = new $className();
        }

        return $badges;
    }

    /**
     *
     */
    public function process()
    {
        $badges = $this->getBadges();
        foreach (Users::find() as $user) {
            $this->processUserBadges($user, $badges);
        }
    }

    /**
     * @param Users $user
     * @param array $badges
     */
    public function processUserBadges(Users $user, $badges)
    {
        foreach ($badges as $badge) {
            if (!$badge->has($user)) {
                $extra = $badge->canHave($user);
                if ($extra) {
                    $badge->add($user, $extra);
                }
            }
        }
    }
}
