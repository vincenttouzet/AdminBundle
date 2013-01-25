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

/**
 * This file is part of VinceTAdminBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class Theme
{
    private $_identifier;
    private $_name;
    private $_basePath;

    /**
     * Gets Identifier
     * 
     * @return [type]
     */
    public function getIdentifier()
    {
        return $this->_identifier;
    }
    
    /**
     * Sets Identifier
     * 
     * @param [type] $identifier Identifier
     * 
     * @return [type]
     */
    public function setIdentifier($identifier)
    {
        $this->_identifier = $identifier;
        return $this;
    }
    

    /**
     * Gets Name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }
    
    /**
     * Sets Name
     * 
     * @param string $name Name
     * 
     * @return Theme
     */
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    /**
     * Gets BasePath
     * 
     * @return string
     */
    public function getBasePath()
    {
        return $this->_basePath;
    }
    
    /**
     * Sets BasePath
     * 
     * @param string $basePath BasePath
     * 
     * @return Theme
     */
    public function setBasePath($basePath)
    {
        $this->_basePath = $basePath;
        return $this;
    }
    
    
}