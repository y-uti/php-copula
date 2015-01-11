<?php
namespace YUti\Copula;

class WriterBuilder extends AbstractBuilder
{
    protected static function defaultRepository()
    {
        return array(
            'contour' => function ($p) { return new ContourPlotWriter(); },
            'csv'     => function ($p) { return new CsvWriter();         },
        );
    }
}
