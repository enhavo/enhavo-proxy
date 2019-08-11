<?php

namespace App\Logger;

use Monolog\Handler\AbstractProcessingHandler;

class EchoHandler extends AbstractProcessingHandler
{
    protected function write(array $record)
    {
        if(isset($record['message'])) {
            echo $record['message']."\n";
        }
    }
}