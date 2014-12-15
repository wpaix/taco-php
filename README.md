![alt tag](https://cloud.githubusercontent.com/assets/6876791/5017065/4e5f8526-6aab-11e4-9d4a-9ee3f6a5fae5.png)

# Taco PHP - Featherweight MVC Framework
* Clean SEO-friendly URLS: www.site.com/something/something-else
* Router supporting wildcards (numbers, strings, both as well as full RegExp support)
* LESS support: Less files are automagically compiled when in development mode
* Development mode takes care developerment/live settings such as error reporting, google anlytics, etc. for you.
* Project structure can be changed to whatever you prefer
* Easily extendable with auto class loading
* Uses the excellent MySQLiDB ORM class for swift database manipulation.
* Autoloads JSON files your views can read from so you don't mix data and representation.
* Automatic CSS/JS asset loading: helps you branch out your CSS/JS and makes sure your code/dependencies are only loaded when needed


# Installation
1. Download and unzip to your web folder
2. Open op the index.php file and update your config, most importantly the URL definition, and if needed your database connection details
3. That's it!


# Controllers
* Found in the 'controllers' folder, unless you define another placement.
* By default, controller look for a view by the same name, if it's to be found.
* $this->route->view = 'something' - Change to any specific view.
* $this->route->css_libraries = '<link href="assets/plugins/library.css" rel="stylesheet">' - Tells the view to load a specific css library. Can contain several libraries.
* $this->route->js_libraries = '<script type="text/javascript" href="assets/plugins/library.js"></script>' - Tells the view to load a specific js library. Can contain several.
* The __global controller is special. As the name implies, it's globally loaded regardless of controllers and views. So place your global code here, that's what it's for. It's got predefined functions set that are executed when TacoPHP does certain things, for instance just when classes or json is loaded, or after the controller has been run.


# Views
* Found in the 'views' folder, unless you define another placement.
* the home.php is for the root of the website.
* by default includes have filenames like these _header.php, _footer.php to tell them apart.
* View specific CSS/JS is loaded if a file with the view name is found in assets/css/view and assets/js/view


# Routes
* Defined in the index.php config under $config['routes']
* Wildcards: :NUM: for any number, :STR: for strings only, :NUMSTR: or :STRNUM: for both. (Synonyms for [a-z] and [0-9])
* Supports RegExp in full
* An asterisk (*) means anything hereafter will match.
* Routes are validated from top to bottom, so if a match is found it will look no further. So ordering can be of importance.


# Database handling
* Only if database details are specified a connection will be made.
* The database is targeted through the $db variable.
* The excellent MySQLiDB ORM class is used for all database handling, documentation found here: https://github.com/joshcam/PHP-MySQLi-Database-Class


# Extending stuff
* Anything placed in the classes folder will be autoloaded, so feel free to inlclude new classes you'll need.
