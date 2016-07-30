# Http

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

An amazing layer for dealing with http requests & responses. It's based on
[guzzle/psr7](https://github.com/guzzle/psr7) Also suports standards PSR1, PSR2,
PSR4 and PSR7. And it's reference is
[rfc3986](https://www.ietf.org/rfc/rfc3986.txt).

## Install

Via Composer, update your composer.json to use martiadrogue/http

```json
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/martiadrogue/http.git"
    }
],
"require": {
    "martiadrogue/http": "dev-devel"
},
```

## Usage

``` php
$skeleton = new MartiAdrogue\Http();
echo $skeleton->echoPhrase('Hello, world!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed
recently.

## Testing

`composer test` run phpcs, phpmd and phpunit. Run phpunit for unit test only.

``` bash
composer test
```

## Code Smell Fix

`composer format` run php-cs-fixer and phpcbf to fix up the PHP code to follow
the coding standards.

``` bash
composer format
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email
marti.adrogue@gmail.com instead of using the issue tracker.

## Credits

- [Martí Adrogué][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/martiadrogue/http.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/martiadrogue/http.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/martiadrogue/http.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/martiadrogue/http.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/martiadrogue/http
[link-scrutinizer]: https://scrutinizer-ci.com/g/martiadrogue/http/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/martiadrogue/http
[link-downloads]: https://packagist.org/packages/martiadrogue/http
[link-author]: https://github.com/martiadrogue
[link-contributors]: ../../contributors

# NOTES

Extraction of `3. Syntax Components` from
[rfc3986](https://www.ietf.org/rfc/rfc3986.txt).

The generic URI syntax consists of a hierarchical sequence of components
referred to as the scheme, authority, path, query, and fragment.

```txt
   URI         = scheme ":" hier-part [ "?" query ] [ "#" fragment ]

   hier-part   = "//" authority path-abempty
               / path-absolute
               / path-rootless
               / path-empty
 ```

The scheme and path components are required, though the path may be
empty (no characters).  When authority is present, the path must
either be empty or begin with a slash ("/") character.  When
authority is not present, the path cannot begin with two slash
characters ("//").  These restrictions result in five different ABNF
rules for a path (Section 3.3), only one of which will match any
given URI reference.

The following are two example URIs and their component parts:

      foo://example.com:8042/over/there?name=ferret#nose
      \_/   \______________/\_________/ \_________/ \__/
       |           |            |            |        |
    scheme     authority       path        query   fragment
       |   _____________________|__
      / \ /                        \
      urn:example:animal:ferret:nose
