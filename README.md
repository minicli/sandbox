# Minicli Sandbox (PHP 8)

This is a PHP 8 Sandbox forked from [erikaheidi/php8-sandbox](https://github.com/erikaheidi/php8-sandbox), including a basic Minicli demo that you can use for experimentation.

## Setting Up

First clone this repository, then run:

```shell
docker-compose up -d
```

Once the container is up, run Composer to install Minicli:

```shell
docker-compose exec app composer install
```

Then, you can run the demo with:

```shell
docker-compose exec app php minicli debug
```

If you want to access the container, you can do so with:

```shell
docker-compose exec app bash
```

This will give you a shell on the PHP 8 sandbox. `Vim` is installed for quick edits inside the container. 

You can also use your regular IDE on the host system to edit files located in this directory, since the Docker Compose setup creates a volume sharing the current folder with the remote user's home directory.

The included `minicli` file is a command-line PHP script restricted to execution from a command-line environment.

This demo application creates a command called `debug` that is set up as an anonymous function. This is the complete code:

```php
#!/usr/bin/env php
<?php

if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use Minicli\App;
use Minicli\Command\CommandCall;

$app = new App();

$app->setSignature('./minicli debug');

$app->registerCommand('debug', function(CommandCall $input) use($app) {
    $printer = $app->getPrinter();
    $printer->info("Minicli 2.0 Sandbox", true);
    $printer->info("System info: PHP " . PHP_VERSION . PHP_EXTRA_VERSION);
    $printer->success("Input info:");

    var_dump($input);

    $printer->display("Check https://docs.minicli.dev for documentation.");
});

$app->runCommand($argv);
```
To learn more about the different ways in which you can create commands, including how to use Command Namespaces for subcommands, check the [official documentation](https://docs.minicli.dev/en/latest/02-command_namespaces/).