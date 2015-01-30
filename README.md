# Puppy Config

[![Latest Stable Version](https://poser.pugx.org/raphhh/puppy-config/v/stable.svg)](https://packagist.org/packages/raphhh/puppy-config)
[![Build Status](https://travis-ci.org/Raphhh/puppy-config.png)](https://travis-ci.org/Raphhh/puppy-config)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/Raphhh/puppy-config/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Raphhh/puppy-config/)
[![Code Coverage](https://scrutinizer-ci.com/g/Raphhh/puppy-config/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Raphhh/puppy-config/)
[![Dependency Status](https://www.versioneye.com/user/projects/54062eb9c4c187ff6100006f/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54062eb9c4c187ff6100006f)
[![Total Downloads](https://poser.pugx.org/raphhh/puppy-config/downloads.svg)](https://packagist.org/packages/raphhh/puppy-config)
[![Reference Status](https://www.versioneye.com/php/raphhh:puppy-config/reference_badge.svg?style=flat)](https://www.versioneye.com/php/raphhh:puppy-config/references)
[![License](https://poser.pugx.org/raphhh/puppy-config/license.svg)](https://packagist.org/packages/raphhh/puppy-config)

Puppy Config load for you your config.

Config basic logic:

- env config management
- dynamic config values

## Installation

Run composer:
```
$ composer require raphhh/puppy-config
```

Add the main config file <project-root>/config/global.php:

```php
// /config/global.php
return [
    'key' => 'value',
];
```

Launch the Config class:

```php
use Puppy\Config\Config;

$config = new Config();
$config->get('key'); // will return 'value'
```

## Multi environment

### How are loaded the files?

In all the cases, Config will load the file 'global.php'. (You can easily change this default file.)

If you specify an env in the constructor, it will load also the associated file. The env config will override the global config.

Fo example:

```php
new Confif('dev'); //will load dev.php
```

### How env can change dynamically?

Set an environment variable in your server virtual host configuration, and retrieve it with the [php getenv() method](http://php.net/manual/en/function.getenv.php).

In your httpd.conf or a .htaccess file of your dev Apache server, put:
```
SetEnv APPLICATION_ENV "dev"
```

In your PHP file, retrieve the env:
```php
new Confif(getenv('APPLICATION_ENV')); //will load dev.php only in your dev server
```

## Dynamic values

You can retrieve dynamically a previous defined value with it key.

```php
// /config/global.php
return [
    'key1' => 'value1',
    'key2' => '%key1%_b', //the value of the key2 will be 'value1_b'
];
```
