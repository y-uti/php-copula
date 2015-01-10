<?php
namespace YUti\Copula;

class CommandLineParser
{
    private $parser;

    public function __construct()
    {
        $this->parser = self::initializeParser();
    }

    static private function initializeParser()
    {
        $parser = new \Console_CommandLine();
        $parser->addOption('copula', array(
            'short_name' => '-c',
            'long_name' => '--copula',
            'description' => '',
            'action' => 'StoreString',
            'default' => 'clayton'
        ));
        $parser->addOption('theta', array(
            'short_name' => '-t',
            'long_name' => '--theta',
            'description' => '',
            'action' => 'StoreFloat',
            'default' => 1
        ));
        $parser->addOption('writer', array(
            'short_name' => '-w',
            'long_name' => '--writer',
            'description' => '',
            'action' => 'StoreString',
            'default' => 'contour'
        ));
        return $parser;
    }

    public function parse()
    {
        $parseResult = $this->parser->parse();

        return $parseResult;
    }
}
