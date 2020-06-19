# Nimiq PHP Client

> PHP implementation of the Nimiq RPC client specs.

## Usage

Send requests to a Nimiq node using a `NimiqCommunity\RpcClient\NimiqClient` object.

```php
$config = [
    'scheme' => 'http',
    'host' => '127.0.0.1',
    'port' => 8648,
    'user' => 'luna',
    'password' => 'moon',
    'timeout' => false,
];

$client = new \NimiqCommunity\RpcClient\NimiqClient($config);
```

Once we have the client, we can start communicating with the Nimiq node.
If no `$config` object is given in constructor it will use same defaults as the Nimiq node defaults.

```php
$client = new \NimiqCommunity\RpcClient\NimiqClient();

// make rpc call to get the block number
$blockNumber = $client->getBlockNumber();

echo $blockNumber; // displays the block number, for example 748883
```

## API

The complete [API documentation](docs) is available in the `/docs` folder.

Check out the [Nimiq RPC specs](https://github.com/nimiq/core-js/wiki/JSON-RPC-API) for behind the scene RPC calls.

## Installation

The recommended way to install Nimiq PHP Client is with Composer. Composer is a dependency management tool for PHP that
allows you to declare the dependencies your project needs and installs them into your project.

```sh
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

You can add Nimiq PHP Client as a dependency using the composer.phar CLI:

```sh
php composer.phar require nimiq-community/php-client
```

Alternatively, you can specify it as a dependency in your project's existing composer.json file:

```json
{
    "require": {
        "nimiq-community/php-client": "^1.0"
    }
}
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

You can find out more on how to install Composer, configure autoloading, and other best-practices for defining dependencies at [getcomposer.org](https://getcomposer.org).

## Contributions

This implementation was originally contributed by [mariofriz](https://github.com/mariofriz/).

Please send your contributions as pull requests.
Refer to the [issue tracker](https://github.com/nimiq-community/php-client/issues) for ideas.

### Develop

After cloning the repository, install the dependencies:

```sh
php composer.phar install
```

All done, happy coding!

### Testing

Tests are stored in the `/tests` folder and can be run using phpunit:

```sh
php composer.phar run-script test
```

To run the tests and generate HTML coverage report:

```sh
php composer.phar run-script coverage
```

This will generate the report in `/coverage` folder. [Xdebug](https://xdebug.org/docs/install) is required to generate the coverage report.

### Documentation

The documentation in the `/docs` folder can generated from the source code:

```sh
php composer.phar run-script docs
```

It will generate a `README.md` in Github Markdown format.

## License

[Apache 2.0](LICENSE.md)
