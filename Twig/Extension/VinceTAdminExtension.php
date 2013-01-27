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

namespace VinceT\AdminBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * VinceTAdminExtension
 *
 * @category VinceT
 * @package  VinceTAdminBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class VinceTAdminExtension extends \Twig_Extension implements ContainerAwareInterface
{
    protected $container = null;

    /**
     * [__construct description]
     *
     * @param ContainerInterface $container [description]
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
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
     * Gets filters
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'render_attributes' => new \Twig_Filter_Method($this, 'renderAttributes', array('is_safe' => array('html'))),
        );
    }

    /**
     * renderAttributes
     *
     * @param array $attributes attributes to render
     * @param array $defaults   defaults value
     *
     * @return [type]
     */
    public function renderAttributes(array $attributes, array $defaults = array())
    {
        $s = '';
        foreach ($attributes as $name => $value) {
            if ( array_key_exists($name, $defaults) ) {
                $value = $value.' '.$defaults[$name];
            }
            $s .= sprintf(' %s="%s"', $name, $value);
        }
        foreach ($defaults as $name => $value) {
            if ( !array_key_exists($name, $attributes) ) {
                $s .= sprintf(' %s="%s"', $name, $value);
            }
        }
        return $s;
    }

    /**
     * Gets global variables
     *
     * @return [type]
     */
    public function getGlobals()
    {
        return array(
            'admin_theme_handler' => $this->container->get('vince_t.admin.theme.handler')
        );
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'vincet_admin';
    }

}
