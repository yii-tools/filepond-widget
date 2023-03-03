<p align="center">
    <a href="https://github.com/yii-tools/filepond-widget" target="_blank">
        <img src="https://avatars.githubusercontent.com/u/121752654?s=200&v=4" height="100px">
    </a>
    <a href="https://pqina.nl/filepond/" target="_blank">
        <img src="https://raw.githubusercontent.com/pqina/filepond-github-assets/master/logo.svg" height="100px">
    </a>    
    <h1 align="center">FilePond widget for YiiFramework v. 3.0.</h1>
    <br>
    <a href="https://pqina.nl/filepond/" target="_blank">
        <img src="/docs/filepond.png" height="100px">
    </a>    
    <br>
</p>

## Requirements

The minimun version of PHP required by this package is PHP 8.1.

For install this package, you need [composer](https://getcomposer.org/), [npm](https://www.npmjs.com/), and [intl extension](https://www.php.net/manual/en/book.intl.php) for PHP.

## Install

```shell
composer require yii-tools/filepond-widget
```

## Usage widget

[Check the documentation docs](/docs/widget.md) to learn about usage.

## Checking dependencies

This package uses [composer-require-checker](https://github.com/maglnet/ComposerRequireChecker) to check if all dependencies are correctly defined in `composer.json`.

To run the checker, execute the following command:

```shell
composer run check-dependencies
```

## Mutation testing

Mutation testing is checked with [Infection](https://infection.github.io/). To run it:

```shell
composer run mutation
```

## Static analysis

The code is statically analyzed with [Psalm](https://psalm.dev/). To run static analysis:

```shell
composer run psalm
```

## Testing

The code is tested with [PHPUnit](https://phpunit.de/). To run tests:

```
composer run test
```

## CI status

[![build](https://github.com/yii-tools/filepond-widget/actions/workflows/build.yml/badge.svg)](https://github.com/yii-tools/filepond-widget/actions/workflows/build.yml)
[![codecov](https://codecov.io/gh/yii-tools/filepond-widget/branch/main/graph/badge.svg?token=MF0XUGVLYC)](https://codecov.io/gh/yii-tools/filepond-widget)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fyii-tools%2Ffilepond-widget%2Fmain)](https://dashboard.stryker-mutator.io/reports/github.com/yii-tools/filepond-widget/main)
[![static analysis](https://github.com/yii-tools/filepond-widget/actions/workflows/static.yml/badge.svg)](https://github.com/yii-tools/filepond-widget/actions/workflows/static.yml)
[![type-coverage](https://shepherd.dev/github/yii-tools/filepond-widget/coverage.svg)](https://shepherd.dev/github/yii-tools/filepond-widget)
[![StyleCI](https://github.styleci.io/repos/598150849/shield?branch=main)](https://github.styleci.io/repos/598150849?branch=main)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Our social networks

[![Twitter](https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555?style=flat)](https://twitter.com/Terabytesoftw)
