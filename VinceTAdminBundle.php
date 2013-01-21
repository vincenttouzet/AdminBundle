<?php

namespace VinceT\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VinceTAdminBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SonataAdminBundle';
    }
}
