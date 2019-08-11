# Maverick
A Laravel Package for Automatic Form Generation and more

# Installing Guide

```bash
composer require travierm/maverick
```


composer.json
```json
"autoload": {
    "psr-4": {
        // ADD ME
        "Travierm\\Maverick\\": "vendor/travierm/maverick/src/"
    },
    "classmap": [
        "database/seeds",
        "database/factories"
    ],
    // ADD ME
    "repositories": [
        {
            "url": "https://github.com/travierm/maverick.git",
            "type": "git"
        }
    ]
,
```

```bash
php artisan vendor:publish
```
