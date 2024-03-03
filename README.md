# Walnut Lang CLI Adapter
A small adapter for performing CLI calls to Walnut language code.

## Installation

To install the latest version, use the following command:

```bash
$ composer require kapitancho/walnut-lang-cli-adapter
```

## Usage

```walnut-lang
module demo-cli:

calc = ^Array<String> => Result<Integer, Any> ::
    ?noError(?noError(#->item(0))->asInteger) +
    ?noError(?noError(#->item(1))->asInteger);

main = ^Array<String> => String :: {
    s = calc(#);
    ?whenTypeOf(s) is {
        type{Integer}: s->asString,
        ~: 'Invalid parameters'
    }
};
```

```bash
php -f cli.php demo-cli 1 2
# Output: 3
```

```bash
php -f cli.php demo-cli 3 cats
# Output: Invalid parameters
```
### Examples

You can browse the [examples](https://github.com/kapitancho/walnut-lang-demos) repository.