VinceTAdminBundle
=================

This bundle extends the [**SonataAdminBundle**][1] and allow two functionnalities:
* Manage the menu from other bundle
* Choose a different design

See [**how to install and configure**][15]

Manage menu
-----------

The SonataAdminBundle main menu (on top of all Admin pages) is generated with the list of Admin objects.

This bundle extends the menu and allows everyone to modify this menu.

The admin menu is generated with [**KnpMenu**][16] library. By default it retrieves all admin groups and labels Admin (like default menu renderer).

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

Theme functionnality
--------------------

There are currently 12 differents themes included with this bundle. These themes are from [**Bootswatch**][2].

* [**Amelia**][3]
* [**Cerulean**][4]
* [**Cosmo**][5]
* [**Cyborg**][6]
* [**Journal**][7]
* [**Readable**][8]
* [**Simplex**][9]
* [**Slate**][10]
* [**Spacelab**][11]
* [**Spruce**][12]
* [**Superhero**][13]
* [**United**][14]


[1]: http://sonata-project.org/bundles/admin/master/doc/index.html
[2]: http://bootswatch.com/
[3]: http://bootswatch.com/amelia
[4]: http://bootswatch.com/cerulean
[5]: http://bootswatch.com/cosmo
[6]: http://bootswatch.com/cyborg
[7]: http://bootswatch.com/journal
[8]: http://bootswatch.com/readable
[9]: http://bootswatch.com/simplex
[10]: http://bootswatch.com/slate
[11]: http://bootswatch.com/spacelab
[12]: http://bootswatch.com/spruce
[13]: http://bootswatch.com/superhero
[14]: http://bootswatch.com/united
[15]: https://github.com/vincenttouzet/AdminBundle/blob/master/Resources/doc/installation.md
[16]: https://github.com/KnpLabs/KnpMenu