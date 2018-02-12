Property Window Client 
========================
[![by](https://img.shields.io/badge/by-%40marcgeurts-blue.svg)](https://github.com/marcgeurts) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/propertywindow/client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/propertywindow/client/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/propertywindow/client/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/propertywindow/client/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/propertywindow/client/badges/build.png?b=master)](https://scrutinizer-ci.com/g/propertywindow/client/build-status/master)

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
$propertyWindow = new Client('email', 'password');
```

* Get property
```php
$property = $propertyWindow->getProperty('id');

$id          = $property->getId();
$subType     = $property->getSubType()->getName();
$terms       = $property->getTerms()->getName();
$street      = $property->getStreet();
$houseNumber = $property->getHouseNumber();
$postcode    = $property->getPostcode();
$city        = $property->getCity();
$country     = $property->getCountry();
$price       = $property->getPrice();
$showPrice   = $property->getTerms()->isShowPrice();
$soldPrice   = $property->getSoldPrice();
$lat         = $property->getLat();
$lng         = $property->getLng();
$online      = $property->isOnline();
$archived    = $property->isArchived();
```

* Get properties
```php
$properties = $propertyWindow->getProperties();

foreach ($properties as $property) {
    $id          = $property->getId();
    $subType     = $property->getSubType()->getName();
    $terms       = $property->getTerms()->getName();
    $street      = $property->getStreet();
    $houseNumber = $property->getHouseNumber();
    $postcode    = $property->getPostcode();
    $city        = $property->getCity();
    $country     = $property->getCountry();
    $price       = $property->getPrice();
    $showPrice   = $property->getTerms()->isShowPrice();
    $soldPrice   = $property->getSoldPrice();
    $lat         = $property->getLat();
    $lng         = $property->getLng();
    $online      = $property->isOnline();
    $archived    = $property->isArchived();
}
```
* Get type
```php
$type = $propertyWindow->getType('id');

$id   = $type->getId();
$type = $type->getName();
```

* Get types
```php
$types = $propertyWindow->getTypes();

foreach ($types as $type) {
    $id   = $type->getId();
    $type = $type->getName();
}
```

* Get subtype
```php
$subType = $propertyWindow->getSubType('id');

$id      = $subType->getId();
$subType = $subType->getName();
$typeId  = $subType->getType()->getId();
$type    = $subType->getType()->getName();
```

* Get subtypes
```php
$subTypes = $propertyWindow->getSubTypes();

foreach ($subTypes as $subType) {
    $id      = $subType->getId();
    $subType = $subType->getName();
    $typeId  = $subType->getType()->getId();
    $type    = $subType->getType()->getName();
}
```
* Get term
```php
$term = $propertyWindow->getTerm('id');

$id        = $term->getId();
$type      = $term->getName();
$showPrice = $term->isShowPrice();
```

* Get terms
```php
$terms = $propertyWindow->getTerms();

foreach ($terms as $term) {
    $id        = $term->getId();
    $term      = $term->getName();
    $showPrice = $term->isShowPrice();
}
```