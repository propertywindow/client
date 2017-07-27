Property Window Client [![by](https://img.shields.io/badge/by-%40marcgeurts-ff69b4.svg?style=flat-square)](https://bitbucket.org/geurtsmarc)
========================

Client for property window agent websites

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

* Make call with authentication details
```php
$client = new Client('host', 'apikey', 'apisecret','userid');
$client->getProperty('id')
```



