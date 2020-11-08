![alt text](taco-php.png)

# Taco PHP
- Extremely lightweight and super easy
- Flexible and can hold anything you put in it
- Made for that small/medium appetite

### Features
- Flexible URL routing that can lead to handlers, controllers or directly to views
- Controllers, views and helper methods
- Database query builder (FluentPDO)
- Loads composer packages if you want to
- Loads .env file if you want to

### Config
The index.php contains your config. Here you can enable composer and .env if you want. (´composer require vlucas/phpdotenv´)

### Routing and controllers/views
You setup routes. They can refer to controllers, views or method handlers.

### Available methods
> baseurl()

> app_root()

> dd($something)

> get_route_path()

> get_route_params()

> get_route_param(0)

> db()->do->something()

> input('any'), input('get'), input('post')

> output(200,(object)['msg' => 'allright!'])

### Database
If you want to play with a database, enable composer and load in envms/fluentpdo (´composer require envms/fluentpdo´)

# Local dev: Serve solution
Serve up some hot tacos by running:
> $ php -S localhost:8000



---




# Milk timetracker
This is a micro tool for quick and easy timetracking, reporting and client view-access.
Our custom Kia platform was overkill.

# Local dev: Serve solution
No MAMP or anything needed. :) Just run:
> $ php -S localhost:8000


# Roadmap
- client > project > timelog
- JSON saving: /database folder. One JSON file per project, one per client
- URL setup, eg: worklog.milk-studio.dk/ctg/93748-vikinglotto2
- URL setup, eg: worklog.milk-studio.dk/28374-ctg












