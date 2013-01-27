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

namespace VinceT\AdminBundle\Menu;

use Knp\Menu\Silex\RouterAwareFactory;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sonata\AdminBundle\Admin\AdminInterface;

/**
 * MenuFactory
 *
 * @category VinceT
 * @package  VinceTAdminBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class MenuFactory extends RouterAwareFactory implements ContainerAwareInterface
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
        parent::__construct($this->container->get('router'));
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
     * Create an item
     *
     * @param string $name    Name of the item
     * @param array  $options Options
     *
     * @return VinceT\AdminBundle\Menu\MenuItem
     */
    public function createItem($name, array $options = array())
    {
        if (!empty($options['admin'])) {
            $admin = $options['admin'];
            if ( !$options['admin'] instanceof AdminInterface ) {
                $admin = $this->container->get('sonata.admin.pool')->getAdminByAdminCode($admin);
            }
            $options['uri'] = $admin->generateUrl('list');
            $options['translationDomain'] = $admin->getTranslationDomain();
        }
        /**
         * Knp\Menu\Silex\RouterAwareFactory
         */
        if (!empty($options['route'])) {
            $params = isset($options['routeParameters']) ? $options['routeParameters'] : array();
            $absolute = isset($options['routeAbsolute']) ? $options['routeAbsolute'] : false;
            $options['uri'] = $this->generator->generate($options['route'], $params, $absolute);
        }
        
        // use VinceT\AdminBundle\Menu\MenuItem
        $item = new MenuItem($name, $this);

        $options = array_merge(
            array(
                'uri' => null,
                'label' => null,
                'attributes' => array(),
                'linkAttributes' => array(),
                'childrenAttributes' => array(),
                'labelAttributes' => array(),
                'extras' => array(),
                'display' => true,
                'displayChildren' => true,
                'translationDomain' => 'messages',
                'displayLink' => true,
                'displayLabel' => true,
            ),
            $options
        );

        $item
            ->setUri($options['uri'])
            ->setLabel($options['label'])
            ->setAttributes($options['attributes'])
            ->setLinkAttributes($options['linkAttributes'])
            ->setChildrenAttributes($options['childrenAttributes'])
            ->setLabelAttributes($options['labelAttributes'])
            ->setExtras($options['extras'])
            ->setDisplay($options['display'])
            ->setDisplayChildren($options['displayChildren'])
            ->setTranslationDomain($options['translationDomain'])
            ->setDisplayLink($options['displayLink'])
            ->setDisplayLabel($options['displayLabel']);

        return $item;

        return parent::createItem($name, $options);
    }
}
