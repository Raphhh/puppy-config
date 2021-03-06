# Puppy Config

[![Latest Stable Version](https://poser.pugx.org/raphhh/puppy-config/v/stable.svg)](https://packagist.org/packages/raphhh/puppy-config)
[![Build Status](https://travis-ci.org/Raphhh/puppy-config.png)](https://travis-ci.org/Raphhh/puppy-config)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/Raphhh/puppy-config/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Raphhh/puppy-config/)
[![Code Coverage](https://scrutinizer-ci.com/g/Raphhh/puppy-config/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Raphhh/puppy-config/)
[![Dependency Status](https://www.versioneye.com/user/projects/54062eb9c4c187ff6100006f/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54062eb9c4c187ff6100006f)
[![Total Downloads](https://poser.pugx.org/raphhh/puppy-config/downloads.svg)](https://packagist.org/packages/raphhh/puppy-config)
[![Reference Status](https://www.versioneye.com/php/raphhh:puppy-config/reference_badge.svg?style=flat)](https://www.versioneye.com/php/raphhh:puppy-config/references)
[![License](https://poser.pugx.org/raphhh/puppy-config/license.svg)](https://packagist.org/packages/raphhh/puppy-config)

Puppy Config is a config manager that loads your config from files according to your env.

Config basic logic:

- env config management (dev, test, prod, ...)
- multi file formats support (php, ini, json, yaml)
- dynamic config values
- visibility restriction

## Installation

Run composer:
```
$ composer require raphhh/puppy-config
```

## Read your config

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
$config['key']; //'value'
```

## Dynamic values

You can retrieve dynamically a previous defined value with it key.

```php
// /config/global.php
return [
    'key1' => 'value1',
    'key2' => '%key1%_b',
];
```
```php
use Puppy\Config\Config;

$config = new Config();
$config['key2']; //'value1_b'
```

## Set new values 

You can set new values on the fly, which will be available in the Config object during all the script (and not saved into a file config).

```php
use Puppy\Config\Config;

$config = new Config();
$config['new_key'] = 'new_value';
```

You can also use the dynamic mapping.
 
```php
$config['new_key2'] = '%new_key%';
$config['new_key2']; //'new_value'
```


## Visibility restriction

You can determine some namespaces in your config, and restrict the visibility of each namespace.

For example, imagine you set this config, with two namespaces: 'a' and 'b'.

```php
//namespace a
$globalConfig['a.a'] = 'a.a';
$globalConfig['a.b'] = 'a.b';

//namespace b
$globalConfig['b.a'] = 'b.a';
$globalConfig['b.b'] = 'b.b';
```

With the global scope config you can access to all the values.

```php
$globalConfig['a.a']; //'a.a'
$globalConfig['b.a']; //'b.a'
```

Now, restrict the config to the namespace 'a':

```php
$restrictedConfig = $globalConfig->restrict('a');
```

With this restricted scope config, you can only have access to the namespace 'a' values:

```php
$restrictedConfig['a']; //'a.a'
$restrictedConfig['b']; //'a.b'
```

The original keys are not visible anymore:

```php
isset($restrictedConfig['a.a']); //false
isset($restrictedConfig['b.a']); //false
```

But, the global scope config is still bound to your restricted scope. So, if you modify one, you modify the other.

```php
$restrictedConfig['a'] = 'new value';
$globalConfig['a.a']; //'new value'
```

## Files format

By default, Config load 'php' files. This kind of file must return a PHP array.

```php
// /config/global.php
return [
    'key' => 'value',
];
```

But you can specify or add specific file formats.

```php
new Config('', null, new YmlFileReader()); //will load config/global.yml
```

Available formats:
 - php (default)
 - ini
 - json
 - yaml

## Multi environment

Your config is the merge of the values coming from three kind of files:

| type          | file name    | loading                   | overloading                    | usage             |
|---------------|--------------|---------------------------|--------------------------------|-------------------|
| global config | global.php   | always loaded             |                                | prod & test       |
| env config    | e.i. dev.php | according to the env      | override global config         | dev               |
| local config  | local.php    | specific for each machine | override global and env config | prod & test - dev |


### When is loaded the global config?

In all the cases, Config will load the file 'global.php'. (You can easily change this default file.)

By default, this is your prod config.

### When is loaded the env config?

If you specify an env in the constructor, it will load also the associated file.

For example:

```php
new Config('dev'); //will load dev.php (in addition to global.php)
```

The env config will override the global config. So, use it for your dev env, which will override your prod params.

#### How env can change dynamically?

Set an environment variable in your server virtual host configuration, and retrieve it with the [php getenv() method](http://php.net/manual/en/function.getenv.php).

In your httpd.conf or a .htaccess file of your dev Apache server, put:
```
SetEnv APP_ENV "dev"
```

In your PHP file, retrieve the env:
```php
new Config(getenv('APP_ENV')); //will load dev.php only in your dev server
```

### What is the local config?

The config will load also a local config, if the file config/local.php exists. 

This config will override the global and the env configs. Be careful: this file must be NOT versioned. 

So, it is an individual config, where your can put temporary or specific config. Your can also put config you do not want to version, like the passwords.
