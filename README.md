# Maverick
A Laravel Package for Automatic Form Generation and more

# Installing Guide

Add to composer.json
```json
"autoload": {
    "psr-4": {
        "Travierm\\Maverick\\": "vendor/travierm/maverick/src/"
    },
 }
,
```
Add to composer.json
```json
"repositories": [
    {
        "url": "https://github.com/travierm/maverick.git",
        "type": "git"
    }
]
```

### Require Maverick
```bash
composer require travierm/maverick
```


### Publish the config file for Maverick
```bash
php artisan vendor:publish --provider Travierm\Maverick\MaverickServiceProvider
```
