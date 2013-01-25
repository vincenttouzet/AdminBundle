Register a new theme
====================

You can register your bundle in app/config/config.yml.
```yml
vince_t_admin:
    themes:
        my_theme:
            name: My custom theme
            base_path: bundles/mybundlename/theme/my_theme
```

Your theme must respect at least the following directory structure under the base path :

```
css
  |-> bootstrap.min.css
js
  |-> bootstrap.min.js
```

Once you register your theme you're able to use it for the admin panel.