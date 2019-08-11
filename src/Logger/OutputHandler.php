<?php

namespace App\Logger;

use Monolog\Handler\AbstractProcessingHandler;
use Symfony\Component\Console\Output\OutputInterface;

class OutputHandler extends AbstractProcessingHandler
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @param array $record
     */
    protected function write(array $record)
    {
        $this->output->writeln($record['message']);
    }

    /**
     * @param OutputInterface $output
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }
}