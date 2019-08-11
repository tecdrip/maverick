# Maverick
A Laravel Package for Automatic Form Generation and more

# Installing Guide

composer.json
```json
"autoload": {
    "psr-4": {
        "Travierm\\Maverick\\": "vendor/travierm/maverick/src/"
    },
    "classmap": [
        "database/seeds",
        "database/factories"
    ],
    "repositories": [
        {
            "url": "https://github.com/travierm/maverick.git",
            "type": "git"
        }
    ]
,
```

### Require Maverick
```bash
composer require travierm/maverick
composer update
```


### Publish the config file for Maverick
```bash
php artisan vendor:publish
```
