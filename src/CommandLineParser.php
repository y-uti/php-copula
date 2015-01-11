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
            'default' => 'clayton',
        ));
        $parser->addOption('theta', array(
            'short_name' => '-t',
            'long_name' => '--theta',
            'description' => '',
            'action' => 'StoreFloat',
            'default' => 1,
        ));
        $parser->addOption('writer', array(
            'short_name' => '-w',
            'long_name' => '--writer',
            'description' => '',
            'action' => 'StoreString',
            'default' => 'contour',
        ));

        $parser->addOption('range', array(
            'short_name' => '-r',
            'long_name' => '--range',
            'description' => '',
            'action' => 'StoreString',
            'default' => '-2:0.4:2',
        ));
        $parser->addOption('xrange', array(
            'long_name' => '--xrange',
            'description' => '',
            'action' => 'StoreString',
        ));
        $parser->addOption('yrange', array(
            'long_name' => '--yrange',
            'description' => '',
            'action' => 'StoreString',
        ));

        $parser->addOption('dist', array(
            'short_name' => '-d',
            'long_name' => '--dist',
            'description' => '',
            'action' => 'StoreString',
            'default' => 'normal',
        ));
        $parser->addOption('xdist', array(
            'long_name' => '--xdist',
            'description' => '',
            'action' => 'StoreString',
        ));
        $parser->addOption('ydist', array(
            'long_name' => '--ydist',
            'description' => '',
            'action' => 'StoreString',
        ));

        $parser->addOption('delta', array(
            'long_name' => '--delta',
            'description' => '',
            'action' => 'StoreFloat',
            'default' => 0.001,
        ));

        return $parser;
    }

    public function parse()
    {
        $parseResult = $this->parser->parse();

        $this->setDefaultIfNull(
            $parseResult->options['xrange'], $parseResult->options['range']);
        $this->setDefaultIfNull(
            $parseResult->options['yrange'], $parseResult->options['range']);

        $parseResult->options['xdata'] =
            $this->buildData($parseResult->options['xrange']);
        $parseResult->options['ydata'] =
            $this->buildData($parseResult->options['yrange']);

        $this->setDefaultIfNull(
            $parseResult->options['xdist'], $parseResult->options['dist']);
        $this->setDefaultIfNull(
            $parseResult->options['ydist'], $parseResult->options['dist']);

        return $parseResult;
    }

    private function setDefaultIfNull(&$value, $default)
    {
        if ($value == null) {
            $value = $default;
        }
    }

    private function buildData($range)
    {
        list ($start, $step, $end) = explode(':', $range);

        return range($start, $end, $step);
    }
}
