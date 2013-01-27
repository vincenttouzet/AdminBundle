<?php
/**
 * This file is part of VinceTAdminBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */

namespace VinceT\AdminBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use VinceT\AdminBundle\Menu\MenuItem;

/**
 * Event thrown when the admin menu is created
 *
 * @category VinceT
 * @package  VinceTAdminBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class MenuCreateEvent extends Event
{
    protected $menu;

    /**
     * __construct
     *
     * @param MenuItem $menu [description]
     */
    public function __construct(MenuItem $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Gets the menu
     *
     * @return \VinceT\AdminBundle\Menu\MenuItem
     */
    public function getMenu()
    {
        return $this->menu;
    }
}