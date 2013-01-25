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

namespace VinceT\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Theme controller
 *
 * @category VinceT
 * @package  VinceTAdminBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class ThemeController extends AdminController
{
    /**
     * Change the current theme used
     *
     * @return RedirectResponse
     */
    public function changeAction()
    {
        $theme = $this->container->get('request')->request->get('admin_theme');
        $this->container->get('vince_t.admin.theme.handler')->setCurrentTheme($theme);
        $headers = $this->container->get('request')->server->getHeaders();
        $referer = $headers['REFERER'];
        return new RedirectResponse($referer);
    }

}
