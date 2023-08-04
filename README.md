![alt text](public/assets/img/taco-php.png)

# Taco PHP
- Extremely lightweight and super easy to use
- Flexible setup. Want to change folder structure? You can have things your way
- Made for that small/medium appetite, but also scalable for larger things
- Comes with included super-basic auth setup, with one login controlled from .env file. You can extended this setup if you want to build something larger.
- Easy database handling with query builder.
- Use crisp blade templates if you want to. Or just use basic PHP templates.
- Comes with a basic frontend setup you can scrap or extend upon.
- Used in production for several projects

### Features
- Flexible URL routing that can lead to handlers, controllers or directly to views
- Controllers, views and helper methods
- Database query builder (FluentPDO)
- Loads composer packages if you want to
- Loads .env file if you want to

### Config
The index.php contains your config. Here you can enable composer and .env if you want. (´composer require vlucas/phpdotenv´)

### Routing and controllers/views
- You setup routes. They can refer to controllers, views or method handlers.
- You can use normal PHP views, or Laravel blade views. For laravel Blade we are using the standalone Blade package (jenssegers/blade)
- For blade views use load_blade_view('viewfile', ['name'='johndoe']) for php views use load_view('viewfile',['name'='johndoe'])

### Database
If you want to play with a database, enable composer and load in envms/fluentpdo (´composer require envms/fluentpdo´)

# Database
- If you want to play with a database, we got the nicest query builder in town ready to play with
- Using PDOx query builder, loaded via composer.  Docs: https://github.com/izniburak/PDOx/blob/master/DOCS.md

# Local dev: Serve solution
Serve up some hot tacos by running:
> $ php -S localhost:8000

# Documentation
- Coming soon. For now, look inside taco.php for reference. The code explains itself — don't we all just love the code-as-docs approach? :D

### Methods
- Look inside the taco.php file to see available methods provided
- Look inside the helpers.php file to see available methods provided.
- If you want to add your own per project, do it to helpers.php

# Roadmap (todo)
- wrap library into a class
- make it work with or without  
    - env file (just load stuff into the construct func)
    - composer
    - router, controller, view (not always necessary)
- make function: is route()
- make function: is_controller() and is_view()
- Perhaps a custom debug log, ala simple debugbar, to be shown somewhere. Can be method invoked, eg. <pre><?=output_debug_log();?></pre> and <?php debug_log('title', $data); ?> and with a list of all sql commands called
- Cleanup helpers so it is almost empty, and all else is in taco.php