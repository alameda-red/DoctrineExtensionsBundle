Alameda Doctrine Extensions bundle
==================================

This bundle provides a couple of mathematical DQL functions to use in Doctrine. Furthermore it provides
a couple of DBAL types.

Installation
------------

You can either modify your composer.json with

```json
{
    "require" : {
        "alameda-red/doctrine-extensions-bundle" : "0.*"
    }
}
```

or run:
```shell
    $ composer require "alameda-red/doctrine-extensions-bundle=0.*"
```

Available DQL functions
-----------------------
* acos
* acosh
* asin
* asinh
* atan
* atan2
* atanh
* cos
* cosh
* degrees
* powe
* radians
* sin
* sinh
* tan
* tanh

There is also the alameda_geo_distance DQL function but due to limitations in the Doctrine DQL parser
it does not work at this point.

Available DQL types
-------------------
### dateinterval
This type will store \DateInterval objects as string representations ('PT1H', 'P1D', ...).

### timestamp
This type will handle UNIX timestamps.