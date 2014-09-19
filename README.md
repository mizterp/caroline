# Caroline - Sentimental Analysis

[![Build Status](https://img.shields.io/travis/certifiedwebninja/caroline/develop.svg?style=flat-square)](https://travis-ci.org/certifiedwebninja/caroline)
[![Coverage Status](https://img.shields.io/coveralls/certifiedwebninja/caroline.svg?style=flat-square)](https://coveralls.io/r/certifiedwebninja/caroline)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/certifiedwebninja/caroline.svg?style=flat-square)](https://packagist.org/packages/certifiedwebninja/caroline)
[![Total Downloads](https://img.shields.io/packagist/dt/certifiedwebninja/caroline.svg?style=flat-square)](https://packagist.org/packages/certifiedwebninja/caroline)


Sentiment analysis tool for PHP based on the [AFINN-111 wordlist](http://www2.imm.dtu.dk/pubdb/views/publication_details.php?id=6010).

## Install

```bash
composer require certifiedwebninja/caroline:1.0.1
```

## Simple Example

```php
use CertifiedWebNinja\Caroline\Analysis;

$caroline = new Analysis;

$result = $caroline->analyze('Hey you worthless scumbag');

echo 'Score: '.$result->getScore().PHP_EOL;
echo 'Comparative: '.$result->getComparative().PHP_EOL;
```

## DataSet Example

By default if no dataset is passed to the constructor, it uses the AFINN dataset. You can create your own datasets or even modify a default dataset.

Here is how you can use another dataset.

```php
use CertifiedWebNinja\Caroline\Analysis;
use CertifiedWebNinja\Caroline\DataSets\AFINN;

$afinn = new AFINN;

$caroline = new Analysis($afinn);

$result = $caroline->analyze('Hey you worthless scumbag');

echo 'Score: '.$result->getScore().PHP_EOL;
echo 'Comparative: '.$result->getComparative().PHP_EOL;
```
This will return the same results as the Simple Example above, what's neat about this though is by instantiating the AFINN dataset before the analysis class, you can replace and even extend the dataset as `AFINN` extends `AbstractDataSet` which gives a few helper methods on the dataset.

### Replace dataset words

```php
$afinn->replace(['love' => 5]);

$caroline = new Analysis($afinn);

$result = $caroline->analyze('I love my cat.');

echo $result->getScore(); // 5
```

### Extend dataset

```php
$afinn->extend(['cat' => 3]);

$caroline = new Analysis($afinn);

$result = $caroline->analyze('I love my cat.');

echo $result->getScore(); // 6 because "love" and "cat" both have a score of 3 each.
```

You can also create your own datasets to use by extending `AbstractDataSet`

```php
<?php namespace Acme;

use CertifiedWebNinja\Caroline\DataSets\AbstractDataSet;

class DataSet extends AbstractDataSet
{
    protected $dataSet = [
        'anvil' => -4,
        'catch' => 3
    ];
}
```
