# Caroline - Sentimental Analysis

[![Build Status](https://img.shields.io/travis/certifiedwebninja/caroline/develop.svg?style=flat-square)](https://travis-ci.org/certifiedwebninja/caroline)
[![Coverage Status](https://img.shields.io/coveralls/certifiedwebninja/caroline.svg?style=flat-square)](https://coveralls.io/r/certifiedwebninja/caroline)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/certifiedwebninja/caroline.svg?style=flat-square)](https://packagist.org/packages/certifiedwebninja/caroline)
[![Total Downloads](https://img.shields.io/packagist/dt/certifiedwebninja/caroline.svg?style=flat-square)](https://packagist.org/packages/certifiedwebninja/caroline)


Sentiment analysis tool for PHP based on the [AFINN-111 wordlist](http://www2.imm.dtu.dk/pubdb/views/publication_details.php?id=6010).

## Install

```bash
composer require certifiedwebninja/caroline:1.0.0
```

## Example

```php
use CertifiedWebNinja\Caroline\Analysis;

$caroline = new Analysis;

$result = $caroline->analyze('Hey you worthless scumbag');

echo 'Score: '.$result->getScore().PHP_EOL;
echo 'Comparative: '.$result->getComparative().PHP_EOL;
```