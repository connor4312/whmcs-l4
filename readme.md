#whmcs-l4
This package is intended to make talking with WHMCS's ugly database (the wtfs-per-minute rate while programming this were quite high) easier in Laravel applications. The state of this package is currently "growing and adding new features and functionality when I need it." You're welcome to contribute to this package, but I don't making functionality for whole of WHMCS's database, at least not all at once.

###Installation
To install this, simply:

```
composer install connor4312/whmcs-l4
```

You will then likely want to publish the package config, in order to add your own details:

```
php artisan config:publish connor4312/whmcs-l4
```

Finally, in `app/config/app.php`, add `Connor4312\WhmcsL4\WhmcsL4ServiceProvider` in your `providers` array, and you probably want to add a facade in your "aliases" array:

```
// ...
        'View'            => 'Illuminate\Support\Facades\View',
        'WHMCS'           => 'Connor4312\WhmcsL4\WhmcsFacade'
// ...
```

###Usage
####API
Firstly, this package provides an easy interface to the WHMCS API. To make API calls, you can simply do the following, where the `action` is a string and `arguments` is an additional list of parameters to pass.

```
WHMCS::api($action, $arguments);
```

This will return an stdclass on success, or false on failure.