Property Window Client [![by](https://img.shields.io/badge/by-%40propertywindow-ff69b4.svg?style=flat-square)](https://github.com/propertywindow)
========================

PHP Client for property window agent websites

## Installation

> Before anything, you need to make sure you have [Composer](https://getcomposer.org) properly setup in your environment.

* Go to project root in your console

* If you don't have a composer.json in your project yet:
```bash
$ composer init
```

* Include this repository
```bash
$ composer require propertywindow/client
```

## Usage

* Setup client with authentication details

```php
use PropertyWindow\Client;
$client = new Client('username', 'password', 'userid');
```

* Get property
```php
$client->getProperty('id');
```

* Get properties
```php
$client->getProperties('limit', 'offset');
```

* Get subtype
```php
$client->getSubType('id');
```
