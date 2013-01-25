<?php

namespace VinceT\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VinceTAdminBundle extends Bundle
{
    protected $parent;

    /**
     * @param string $parent
     */
    public function __construct($parent = 'SonataAdminBundle')
    {
        $this->parent = $parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this->parent;
    }
    
}
