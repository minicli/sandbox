<?php

namespace App\Command\Hello;

use Minicli\Command\CommandController;

class DefaultController extends CommandController
{
    public function handle()
    {       
        $this->getPrinter()->display("Hello MiniCLI!");
    }
}