# Omnipay: Swipehq

**Swipe HQ driver for the Omnipay PHP payment processing library**

Swipe HQ Website: http://www.swipehq.co.nz

[Omnipay](https://github.com/omnipay/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Swipehq support for Omnipay v2.3.

## Installation
Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/antonythorpe/omnipay-swipehq"
            }
        ],
    "require": {
        "antonythorpe/omnipay-swipehq": "2.0.0"
    }
}
```
Reference: https://getcomposer.org/doc/05-repositories.md#using-private-repositories

Run composer to update your dependencies:
```
composer update
```
 
## Getting Started

- Swipe HQ is an Offsite Payment Gateway so for the Live Payment Notifications (Swipe HQ's servers to yours) to work, you will need a staging server.  The Live Payment Notifications will not be able to find your localhost.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

Other than that, there is no support for this library.
