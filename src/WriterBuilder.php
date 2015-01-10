<?php
namespace YUti\Copula;

class WriterBuilder extends AbstractBuilder
{
    public function __construct()
    {
        $this->repository = self::defaultRepository();
    }

    private static function defaultRepository()
    {
        return array(
            'contour' => function ($p) { return new ContourPlotWriter(); },
            'csv'     => function ($p) { return new CsvWriter();         },
        );
    }
}
