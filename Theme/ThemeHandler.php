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

namespace VinceT\AdminBundle\Theme;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * This file is part of VinceTAdminBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class ThemeHandler implements ContainerAwareInterface
{
    protected $container = null;
    private $_default = null;
    private $_themes = null;

    /**
     * [__construct description]
     *
     * @param ContainerInterface $container [description]
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
        $this->_getThemes();
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface $container A ContainerInterface instance
     *
     * @return null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Gets a Theme by its identifier
     *
     * @param string $identifier Theme identifier
     *
     * @return Theme
     */
    public function getTheme($identifier)
    {
        $themes = $this->getAvailableThemes();
        if ( !isset($themes[$identifier]) ) {
            $themeIds = array();
            foreach ($themes as $key => $value) {
                $themeIds[] = $key;
            }
            throw new \Exception(sprintf('Theme "%s" does not exist. Possible values are [%s]', $identifier, implode(', ', $themeIds)), 1);
        }
        return $themes[$identifier];
    }

    /**
     * Gets the default theme to use
     *
     * @return string
     */
    public function getDefaultTheme()
    {
        $config = $this->container->getParameter('vince_t.admin.theme');
        return $this->getTheme($config['default_theme']);
    }

    /**
     * Gets the current theme used
     *
     * @return Theme
     */
    public function getCurrentTheme()
    {
        $theme = $this->getDefaultTheme();
        if ( $this->container->get('session')->has('_admin_theme') ) {
            $theme = $this->container->get('session')->get('_admin_theme');
        }
        return $theme;
    }

    /**
     * Sets the current theme
     *
     * @param string $identifier [description]
     *
     * @return null 
     */
    public function setCurrentTheme($identifier)
    {
        $theme = $this->getTheme($identifier);
        $this->container->get('session')->set('_admin_theme', $theme);
    }

    /**
     * Gets the URI for a file
     *
     * @param string $file [description]
     *
     * @return string
     */
    public function getUri($file)
    {
        return $this->getCurrentTheme()->getBasePath().'/'.$file;
    }

    /**
     * Gets the available themes
     *
     * @return array
     */
    public function getAvailableThemes()
    {
        return $this->_getThemes();
    }

    /**
     * Gets the theme config
     *
     * @return array
     */
    private function _getThemeConfig()
    {
        return $this->container->getParameter('vince_t.admin.theme');
    }

    /**
     * Gets themes
     *
     * @return array
     */
    private function _getThemes()
    {
        if ( is_null($this->_themes) ) {
            $config = $this->_getThemeConfig();
            $this->_themes = array();
            foreach ($config['themes'] as $identifier => $conf) {
                $t = new Theme();
                $t->setIdentifier($identifier);
                $t->setName($conf['name']);
                $t->setBasePath($conf['base_path']);
                $this->_themes[$identifier] = $t;
            }
        }
        return $this->_themes;
    }

}