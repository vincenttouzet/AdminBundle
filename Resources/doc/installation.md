VinceTAdminBundle installation steps
====================================

1) Installing the bundle
------------------------

Use composer to install this bundle (using the master version)
```
php composer.phar require vincet/admin-bundle
```

2) Register the bundle
----------------------

In app/appKernel.php add the following line to register the bundle:
```php
[...]
            new VinceT\AdminBundle\VinceTAdminBundle('SonataAdminBundle'),
[...]
```

If you have already a bundle that extends the SonataAdminBundle, you can change the parent of the VinceTAdminBundle to the other bundle by changing the parameter.

3) Configure
------------

In app/config/config.yml add the following section:
```yml
vince_t_admin:
    default_theme: default
    themes:
        amelia:
            name: Amelia
            base_path: bundles/vincetadmin/bootstrap/amelia
        cerulean:
            name: Cerulean
            base_path: bundles/vincetadmin/bootstrap/cerulean
        cosmo:
            name: Cosmo
            base_path: bundles/vincetadmin/bootstrap/cosmo
        cyborg:
            name: Cyborg
            base_path: bundles/vincetadmin/bootstrap/cyborg
        default:
            name: Default
            base_path: bundles/vincetadmin/bootstrap/default
        journal:
            name: Journal
            base_path: bundles/vincetadmin/bootstrap/journal
        readable:
            name: Readable
            base_path: bundles/vincetadmin/bootstrap/readable
        simplex:
            name: Simplex
            base_path: bundles/vincetadmin/bootstrap/simplex
        slate:
            name: Slate
            base_path: bundles/vincetadmin/bootstrap/slate
        spacelab:
            name: Spacelab
            base_path: bundles/vincetadmin/bootstrap/spacelab
        spruce:
            name: Spruce
            base_path: bundles/vincetadmin/bootstrap/spruce
        superhero:
            name: Superhero
            base_path: bundles/vincetadmin/bootstrap/superhero
        united:
            name: United
            base_path: bundles/vincetadmin/bootstrap/united
```

This set the default theme and register the available themes. You can [**add your own theme**][1].

In app/config/routing.yml add :
```yml
vince_t_admin:
    resource: "@VinceTAdminBundle/Resources/config/routing.yml"
    prefix:   /
```

This register the route to change the theme used.

[1]: https://github.com/vincenttouzet/AdminBundle/blob/master/Resources/doc/add_theme.md