# Maverick
A Laravel Package for Automatic Form Generation and more

# Installing Guide

Add to composer.json
```json
"autoload": {
    "psr-4": {
        "Tecdrip\\Maverick\\": "vendor/Tecdrip/maverick/src/"
    },
 }
,
```
Add to composer.json
```json
"repositories": [
    {
        "url": "https://github.com/Tecdrip/maverick.git",
        "type": "git"
    }
]
```

### Require Maverick
```bash
composer require Tecdrip/maverick
```


### Publish the config file for Maverick
```bash
php artisan vendor:publish --provider Tecdrip\Maverick\MaverickServiceProvider
```
