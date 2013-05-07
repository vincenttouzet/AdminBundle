VinceTAdminBundle
=================

This bundle extends the [**SonataAdminBundle**][1] and allow the possibility to manage the menu from other bundle.

See [**how to install and configure**][2]

Manage menu
-----------

The SonataAdminBundle main menu (on top of all Admin pages) is generated with the list of Admin objects.

This bundle extends the menu and allows everyone to modify this menu.

The admin menu is generated with [**KnpMenu**][3] library. By default it retrieves all admin groups and labels Admin (like default menu renderer).

To modify the admin menu juste create a listener :
```php

namespace VinceT\TestBundle\EventListener;


class MenuListener
{
    public function createMenu($event)
    {
        $menu = $event->getMenu();

        // create a new groupe
        $menu->addChild('System', array('translationDomain'=>'MyDomain'));

        // move user to System group
        $users = $menu->pop('sonata_user');
        $menu['System']->addChild($users);
        
        // add a divider to System group
        $menu['System']->addDivider();
        // ad a nav header
        $menu['System']->addNavHeader('Informations');

        // add About child
        $menu['System']->addChild('About', array('uri'=>'#'));
        // add children to About
        $menu['System']['About']->addChild('Symfony', array('uri'=>'http://symfony.com'));
        $menu['System']['About']->addChild(
            'SonataAdminBundle', 
            array(
                'uri'=>'http://sonata-project.org/bundles/admin/master/doc/index.html'
            )
        );
        $menu['System']['About']->addChild('VinceTAdminBundle', array('uri'=>''));

    }
}
```

And just declare the listener in your services.yml file.

```yml
services:
    kernel.listener.admin_menu_listener:
        class: VinceT\TestBundle\EventListener\MenuListener
        tags:
            - { name: kernel.event_listener, event: admin.menu.create, method: createMenu }
```

This bundle use a custom MenuItem class `VinceT\AdminBundle\Menu\MenuItem` that extends the `Knp\Menu\MenuItem`. It add new functions (to add dividers, nav headers, ...)



[1]: http://sonata-project.org/bundles/admin/master/doc/index.html
[2]: https://github.com/vincenttouzet/AdminBundle/blob/master/Resources/doc/installation.md
[3]: https://github.com/KnpLabs/KnpMenu