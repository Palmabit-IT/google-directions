# Google Directions

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]


PHP Wrapper for Google directions API.
For further information see https://developers.google.com/maps/documentation/directions/intro

NOTE: still considered under development, which means that things might change a lot. If you want to use it anyway, just remember that future releases might contain breaking changes.

## Install

Via Composer

``` bash
$ composer require palmabit/google-directions
```

## Usage

``` php
$apikey = 'my-google-apikey';
$gd = new Palmabit\GoogleDirections\GoogleDirections($apikey);
```

or

``` php
GoogleDirections::setApikey($apikey);
$gd = new GoogleDirections();
```
then

``` php

/*
 * Example of API call:
 * https://maps.googleapis.com/maps/api/directions/json?origin=Milano&destination=Venezia&key=my-google-apikey
 *
 * with a timeout of 40s, defaults to 30s if empty
 */

$direction = $gd
    ->createDirectionAPI()
    ->setTimeout(4000)
    ->setOrigin('Milano')
    ->setDestination('Verona')
    ->call();

/*
 * now you can use all $direction methods
 * see above for detailed lists
 */

//get the status
$status = $direction->getStatus();

//get the distance between Milan and Venice
$distance = $direction->getDistance();

//get summary
$summary = $direction->getSummary();

//get steps
$steps = $direction->getSteps();

//get duration
$duration = $direction->getDuration();


```



## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email hello@palmabit.com instead of using the issue tracker.

## Credits

- [Palmabit Srl][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/palmabit/google-directions.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Palmabit-IT/google-directions/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/Palmabit-IT/google-directions.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Palmabit-IT/google-directions.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/Palmabit-IT/google-directions.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/palmabit/google-directions
[link-travis]: https://travis-ci.org/Palmabit-IT/google-directions
[link-scrutinizer]: https://scrutinizer-ci.com/g/Palmabit-IT/google-directions/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/Palmabit-IT/google-directions
[link-author]: https://github.com/Palmabit-IT
[link-contributors]: ../../contributors
