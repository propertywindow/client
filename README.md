Property Window Client 
========================

PHP Client for property window agent websites 

[![by](https://img.shields.io/badge/by-%40propertywindow-ff69b4.svg?style=flat-square)](https://github.com/propertywindow) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/propertywindow/client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/propertywindow/client/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/propertywindow/client/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/propertywindow/client/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/propertywindow/client/badges/build.png?b=master)](https://scrutinizer-ci.com/g/propertywindow/client/build-status/master)

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
$propertyWindow = new Client('email', 'password');
```

* Get property
```php
$propertyWindow->getProperty('id');
```

* Get properties
```php
$propertyWindow->getProperties('limit', 'offset');

foreach ($properties as $property) {
    $street = $property->getStreet();
}
```

* Get subtype
```php
$propertyWindow->getSubType('id');
```

* Get subtypes
```php
$propertyWindow->getSubTypes();
```
