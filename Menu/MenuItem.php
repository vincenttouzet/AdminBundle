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

use Knp\Menu\MenuItem as BaseItem;

/**
 * MenuItem
 *
 * @category VinceT
 * @package  VinceTAdminBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class MenuItem extends BaseItem
{
    protected $translationDomain = null;
    protected $displayLink = true;
    protected $displayLabel = true;
    protected $nbDividers = 0;

    /**
     * Gets TranslationDomain
     * 
     * @return [type]
     */
    public function getTranslationDomain()
    {
        return $this->translationDomain;
    }
    
    /**
     * Sets TranslationDomain
     * 
     * @param [type] $translationDomain TranslationDomain
     * 
     * @return [type]
     */
    public function setTranslationDomain($translationDomain)
    {
        $this->translationDomain = $translationDomain;
        return $this;
    }

    /**
     * Gets DisplayLink
     * 
     * @return [type]
     */
    public function isLinkDisplayed()
    {
        return $this->displayLink;
    }
    
    /**
     * Sets DisplayLink
     * 
     * @param [type] $displayLink DisplayLink
     * 
     * @return [type]
     */
    public function setDisplayLink($displayLink)
    {
        $this->displayLink = $displayLink;
        return $this;
    }

    /**
     * Gets DisplayLabel
     * 
     * @return [type]
     */
    public function isLabelDisplayed()
    {
        return $this->displayLabel;
    }
    
    /**
     * Sets DisplayLabel
     * 
     * @param [type] $displayLabel DisplayLabel
     * 
     * @return [type]
     */
    public function setDisplayLabel($displayLabel)
    {
        $this->displayLabel = $displayLabel;
        return $this;
    }
    
    /**
     * Add a divider
     *
     * @return VinceT\AdminBundle\Menu\MenuItem
     */
    public function addDivider()
    {
        $name = $this->getName().'_divider_'.$this->nbDividers;
        $child = $this->factory->createItem($name);

        $child->setParent($this);
        $child->setCurrentUri($this->getCurrentUri());

        $child->setChildrenAttribute('class', 'divider');
        $child->setDisplayLink(false);
        $child->setDisplayLabel(false);

        $this->children[$child->getName()] = $child;

        $this->nbDividers++;
        return $child;
    }

    /**
     * Add a divider
     *
     * @param string $name Nav header label
     *
     * @return VinceT\AdminBundle\Menu\MenuItem
     */
    public function addNavHeader($name)
    {
        $child = $this->factory->createItem($name);

        $child->setParent($this);
        $child->setCurrentUri($this->getCurrentUri());

        $child->setChildrenAttribute('class', 'nav-header');
        $child->setDisplayLink(false);

        $this->children[$child->getName()] = $child;

        return $child;
    }

    /**
     * Remove and return a menu
     *
     * @param string $name [description]
     *
     * @return VinceT\AdminBundle\Menu\MenuItem
     */
    public function pop($name)
    {
        $menu = $this[$name];
        $this->removeChild($name);
        return $menu;
    }
    
    
}
